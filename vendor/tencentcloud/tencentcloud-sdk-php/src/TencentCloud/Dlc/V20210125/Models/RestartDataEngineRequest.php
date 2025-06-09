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
namespace TencentCloud\Dlc\V20210125\Models;
use TencentCloud\Common\AbstractModel;

/**
 * RestartDataEngine请求参数结构体
 *
 * @method string getDataEngineId() 获取引擎ID
 * @method void setDataEngineId(string $DataEngineId) 设置引擎ID
 * @method boolean getForcedOperation() 获取是否强制重启，忽略任务
 * @method void setForcedOperation(boolean $ForcedOperation) 设置是否强制重启，忽略任务
 */
class RestartDataEngineRequest extends AbstractModel
{
    /**
     * @var string 引擎ID
     */
    public $DataEngineId;

    /**
     * @var boolean 是否强制重启，忽略任务
     */
    public $ForcedOperation;

    /**
     * @param string $DataEngineId 引擎ID
     * @param boolean $ForcedOperation 是否强制重启，忽略任务
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
        if (array_key_exists("DataEngineId",$param) and $param["DataEngineId"] !== null) {
            $this->DataEngineId = $param["DataEngineId"];
        }

        if (array_key_exists("ForcedOperation",$param) and $param["ForcedOperation"] !== null) {
            $this->ForcedOperation = $param["ForcedOperation"];
        }
    }
}
