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
 * CreateGovernanceNamespaces请求参数结构体
 *
 * @method string getInstanceId() 获取tse 实例id。
 * @method void setInstanceId(string $InstanceId) 设置tse 实例id。
 * @method array getGovernanceNamespaces() 获取命名空间信息。
 * @method void setGovernanceNamespaces(array $GovernanceNamespaces) 设置命名空间信息。
 */
class CreateGovernanceNamespacesRequest extends AbstractModel
{
    /**
     * @var string tse 实例id。
     */
    public $InstanceId;

    /**
     * @var array 命名空间信息。
     */
    public $GovernanceNamespaces;

    /**
     * @param string $InstanceId tse 实例id。
     * @param array $GovernanceNamespaces 命名空间信息。
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

        if (array_key_exists("GovernanceNamespaces",$param) and $param["GovernanceNamespaces"] !== null) {
            $this->GovernanceNamespaces = [];
            foreach ($param["GovernanceNamespaces"] as $key => $value){
                $obj = new GovernanceNamespaceInput();
                $obj->deserialize($value);
                array_push($this->GovernanceNamespaces, $obj);
            }
        }
    }
}
