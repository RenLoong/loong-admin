local function get_script_dir()
    local lfs_ok, lfs = pcall(require, "lfs")

    local source
    if debug and debug.getinfo then
        -- OpenResty 或标准 Lua 都适用
        source = debug.getinfo(2, "S").source:sub(2)
    elseif arg and arg[0] then
        source = arg[0]
    else
        return nil
    end

    -- 如果是相对路径，转换为绝对路径
    if not source:match("^/") then
        if lfs_ok then
            source = lfs.currentdir() .. "/" .. source
        else
            -- 没有 lfs，使用 io.popen("pwd") 获取当前目录
            local handle = io.popen("pwd")
            local cwd = handle:read("*l")
            handle:close()
            source = cwd .. "/" .. source
        end
    end

    -- 提取目录
    local dir = source:match("(.*/)")
    return dir
end

package.path = package.path .. ";"..get_script_dir().."module/?.lua;"
-- 如过不是以/app/开头的请求，不进行QPS控制
local request_uri = ngx.var.request_uri
if not string.match(request_uri, "^/app/") then
    return
end

-- 获取请求方法
local method = ngx.req.get_method()
method=tostring(method)

-- 获取请求路径
local path = string.match(request_uri, "([^?]*)")
path=tostring(path)

local env = require("load_env")
-- 连接Redis
local redis = require "resty.redis"
local red = redis:new()
red:set_timeout(1000) -- 1 秒超时
 
local ok, err = red:connect(env.get("REDIS_HOST","127.0.0.1"), env.get("REDIS_PORT",6379,"number"))
if not ok then
    ngx.log(ngx.ERR,"Connection to Redis failed: ", err)
    return
end

local database = env.get("REDIS_DATABASE",2,"number")
 -- 选择数据库
local ok,err = red:select(database)
if not ok then
    ngx.log(ngx.ERR,"Failed to select Redis database ",database,": ", err)
    return
end

-- 获取请求限制
local limit_key="QPS:"..method..":"..path
local limit, err = red:get(limit_key)
limit = tonumber(limit)

-- 如果没有设置限制，则不进行QPS控制
if not limit  then
    return
end

-- 获取请求头中的Authorization
local authorization=ngx.var.http_authorization
if not authorization then
    ngx.log(ngx.ERR,"The request header does not include Authorization: ",authorization)
    return ngx.exit(401)
end

-- 拼接用户key
authorization=tostring(authorization)
local user_key = limit_key..":"..authorization

-- 获取用户请求次数
local requests, err = red:get(user_key)
requests = tonumber(requests)

if not requests then
    requests = 0
end

-- 如果请求次数超过限制，则返回503
if requests > limit then
    ngx.log(ngx.ERR,limit,"qps/s, Authorization: ",authorization)
    return ngx.exit(503)
end

 
-- 原子增加请求次数
local ok, err = red:incr(user_key)
if not ok then
    ngx.log(ngx.ERR,"Redis increment operation failed: ", err)
    return
end

local ok, err = red:expire(user_key, 1)
if not ok then
    ngx.log(ngx.ERR,"Failed to set expiration for Redis key: ", err)
    return
end

-- 释放连接（连接池实现）
local ok, err = red:set_keepalive(10000, 100)
if not ok then
    ngx.log(ngx.ERR,"Failed to set keepalive: ", err)
    return
end