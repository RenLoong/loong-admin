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
namespace TencentCloud\Cynosdb\V20190107\Models;
use TencentCloud\Common\AbstractModel;

/**
 * OpenWan请求参数结构体
 *
 * @method string getInstanceGrpId() 获取实例组id
 * @method void setInstanceGrpId(string $InstanceGrpId) 设置实例组id
 * @method string getInstanceId() 获取实例ID
 * @method void setInstanceId(string $InstanceId) 设置实例ID
 * @method string getInstanceGroupId() 获取实例组id
 * @method void setInstanceGroupId(string $InstanceGroupId) 设置实例组id
 */
class OpenWanRequest extends AbstractModel
{
    /**
     * @var string 实例组id
     * @deprecated
     */
    public $InstanceGrpId;

    /**
     * @var string 实例ID
     */
    public $InstanceId;

    /**
     * @var string 实例组id
     */
    public $InstanceGroupId;

    /**
     * @param string $InstanceGrpId 实例组id
     * @param string $InstanceId 实例ID
     * @param string $InstanceGroupId 实例组id
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
        if (array_key_exists("InstanceGrpId",$param) and $param["InstanceGrpId"] !== null) {
            $this->InstanceGrpId = $param["InstanceGrpId"];
        }

        if (array_key_exists("InstanceId",$param) and $param["InstanceId"] !== null) {
            $this->InstanceId = $param["InstanceId"];
        }

        if (array_key_exists("InstanceGroupId",$param) and $param["InstanceGroupId"] !== null) {
            $this->InstanceGroupId = $param["InstanceGroupId"];
        }
    }
}
