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
 * DeleteDataEngine请求参数结构体
 *
 * @method array getDataEngineNames() 获取删除虚拟集群的名称数组
 * @method void setDataEngineNames(array $DataEngineNames) 设置删除虚拟集群的名称数组
 */
class DeleteDataEngineRequest extends AbstractModel
{
    /**
     * @var array 删除虚拟集群的名称数组
     */
    public $DataEngineNames;

    /**
     * @param array $DataEngineNames 删除虚拟集群的名称数组
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
        if (array_key_exists("DataEngineNames",$param) and $param["DataEngineNames"] !== null) {
            $this->DataEngineNames = $param["DataEngineNames"];
        }
    }
}