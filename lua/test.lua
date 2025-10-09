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
local env = require("load_env")
print("ENV文件加载成功，服务名称："..env.get("SERVER_NAME"))


-- 测试
print(get_script_dir())
