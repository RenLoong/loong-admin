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
namespace TencentCloud\Tse\V20201207\Models;
use TencentCloud\Common\AbstractModel;

/**
 * ModifyConfigFiles请求参数结构体
 *
 * @method string getInstanceId() 获取ins-df344df5	
 * @method void setInstanceId(string $InstanceId) 设置ins-df344df5	
 * @method ConfigFile getConfigFile() 获取配置文件列表
 * @method void setConfigFile(ConfigFile $ConfigFile) 设置配置文件列表
 */
class ModifyConfigFilesRequest extends AbstractModel
{
    /**
     * @var string ins-df344df5	
     */
    public $InstanceId;

    /**
     * @var ConfigFile 配置文件列表
     */
    public $ConfigFile;

    /**
     * @param string $InstanceId ins-df344df5	
     * @param ConfigFile $ConfigFile 配置文件列表
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
        if (array_key_exists("InstanceId",$param) and $param["InstanceId"] !== null) {
            $this->InstanceId = $param["InstanceId"];
        }

        if (array_key_exists("ConfigFile",$param) and $param["ConfigFile"] !== null) {
            $this->ConfigFile = new ConfigFile();
            $this->ConfigFile->deserialize($param["ConfigFile"]);
        }
    }
}
