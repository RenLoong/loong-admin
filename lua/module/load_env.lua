--[[
load_env.lua
功能：
  自动读取 .env 文件（优先当前目录，其次模块上一级目录），解析为键值表。
  提供安全的 env.get(key, default, type) 方法：
    - 不存在 .env 文件或 key 时返回 default
    - 支持类型转换（string / number / boolean）
使用示例：
  local env = require("load_env")
  local port = env.get("SERVER_PORT", 8080, "number")
  local debug = env.get("DEBUG", false, "boolean")
]]
local config = require "config"
local M = {}
local env_cache = nil

------------------------------------------------------------
-- 工具函数
------------------------------------------------------------

-- 读取文件内容
local function read_file(path)
    local file = io.open(path, "r")
    if not file then return nil end
    local content = file:read("*a")
    file:close()
    -- 去掉 UTF-8 BOM
    if content:sub(1,3) == "\239\187\191" then
        content = content:sub(4)
    end
    return content
end

-- 解析 .env 文件为表
local function parse_env(content)
    local env = {}
    if not content then return env end
    for line in content:gmatch("[^\r\n]+") do
        if not line:match("^%s*#") and line:match("%S") then
            local key, value = line:match("^%s*([%w_]+)%s*=%s*(.-)%s*$")
            if key then
                value = value:gsub("^['\"](.-)['\"]$", "%1")
                env[key] = value
            end
        end
    end
    return env
end

-- 自动搜索 .env 文件路径
local function find_env()
    local dirs = {
        config.root_path .. "/lua/",              -- Lua目录
        config.root_path .. "/"              -- 项目跟目录
    }
    for _, dir in ipairs(dirs) do
        local path = dir .. ".env"
        local f = io.open(path, "r")
        if f then f:close() return path end
    end
    return nil
end


------------------------------------------------------------
-- 主逻辑
------------------------------------------------------------

local function load_env()
    if env_cache then return env_cache end
    local env_path = find_env()
    if not env_path then
        print("未找到 .env 文件，返回空表")
        env_cache = {}
        return env_cache
    end
    print("加载 .env 文件路径: " .. env_path)
    local content = read_file(env_path)
    env_cache = parse_env(content)
    return env_cache
end

-- 类型转换
local function convert_type(value, expect_type)
    if expect_type == "number" then
        return tonumber(value)
    elseif expect_type == "boolean" then
        local v = tostring(value):lower()
        return (v == "true" or v == "1" or v == "yes" or v == "on")
    else
        return tostring(value)
    end
end

------------------------------------------------------------
-- 导出接口
------------------------------------------------------------

--- 获取单个键值
-- @param key string 键名
-- @param default any 默认值
-- @param expect_type string 期望类型: "string" | "number" | "boolean"
function M.get(key, default, expect_type)
    expect_type = expect_type or "string"
    local env = load_env()
    local val = env[key]
    if val == nil or val == "" then
        return default
    end
    local converted = convert_type(val, expect_type)
    if converted == nil then
        return default
    end
    return converted
end

-- 获取完整表
function M.all()
    return load_env()
end

return M
