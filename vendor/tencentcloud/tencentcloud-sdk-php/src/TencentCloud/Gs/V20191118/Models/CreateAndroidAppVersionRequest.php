<?php
/*
 * Copyright (c) 2017-2018 THL A29 Limited, a Tencent company. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace TencentCloud\Gs\V20191118\Models;
use TencentCloud\Common\AbstractModel;

/**
 * CreateAndroidAppVersion请求参数结构体
 *
 * @method string getAndroidAppId() 获取应用ID
 * @method void setAndroidAppId(string $AndroidAppId) 设置应用ID
 * @method string getDownloadUrl() 获取应用包下载地址
 * @method void setDownloadUrl(string $DownloadUrl) 设置应用包下载地址
 * @method string getCommand() 获取应用 shell 安装命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
 * @method void setCommand(string $Command) 设置应用 shell 安装命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
 * @method string getUninstallCommand() 获取应用 shell 卸载命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
 * @method void setUninstallCommand(string $UninstallCommand) 设置应用 shell 卸载命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
 */
class CreateAndroidAppVersionRequest extends AbstractModel
{
    /**
     * @var string 应用ID
     */
    public $AndroidAppId;

    /**
     * @var string 应用包下载地址
     */
    public $DownloadUrl;

    /**
     * @var string 应用 shell 安装命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
     */
    public $Command;

    /**
     * @var string 应用 shell 卸载命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
     */
    public $UninstallCommand;

    /**
     * @param string $AndroidAppId 应用ID
     * @param string $DownloadUrl 应用包下载地址
     * @param string $Command 应用 shell 安装命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
     * @param string $UninstallCommand 应用 shell 卸载命令（支持多条命令执行，通过 && 组合；只在应用 AppMode 为 ADVANCED 高级模式下 才会生效）
     */
    function __construct()
    {

    }

    /**
     * For internal only. DO NOT USE IT.
     */
    public function deserialize($param)
    {
        if ($param === null) {
            return;
        }
        if (array_key_exists("AndroidAppId",$param) and $param["AndroidAppId"] !== null) {
            $this->AndroidAppId = $param["AndroidAppId"];
        }

        if (array_key_exists("DownloadUrl",$param) and $param["DownloadUrl"] !== null) {
            $this->DownloadUrl = $param["DownloadUrl"];
        }

        if (array_key_exists("Command",$param) and $param["Command"] !== null) {
            $this->Command = $param["Command"];
        }

        if (array_key_exists("UninstallCommand",$param) and $param["UninstallCommand"] !== null) {
            $this->UninstallCommand = $param["UninstallCommand"];
        }
    }
}
