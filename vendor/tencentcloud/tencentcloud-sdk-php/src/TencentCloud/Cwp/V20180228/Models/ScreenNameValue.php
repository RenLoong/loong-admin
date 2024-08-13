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
namespace TencentCloud\Cwp\V20180228\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 【云安全预警】大屏可视化数据Name Value 数据
 *
 * @method string getName() 获取统计类型 不同接口对应不同的内容
 * @method void setName(string $Name) 设置统计类型 不同接口对应不同的内容
 * @method integer getValue() 获取统计数量
 * @method void setValue(integer $Value) 设置统计数量
 */
class ScreenNameValue extends AbstractModel
{
    /**
     * @var string 统计类型 不同接口对应不同的内容
     */
    public $Name;

    /**
     * @var integer 统计数量
     */
    public $Value;

    /**
     * @param string $Name 统计类型 不同接口对应不同的内容
     * @param integer $Value 统计数量
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
        if (array_key_exists("Name",$param) and $param["Name"] !== null) {
            $this->Name = $param["Name"];
        }

        if (array_key_exists("Value",$param) and $param["Value"] !== null) {
            $this->Value = $param["Value"];
        }
    }
}
