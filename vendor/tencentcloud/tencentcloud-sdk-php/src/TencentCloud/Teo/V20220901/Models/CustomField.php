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
namespace TencentCloud\Teo\V20220901\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 实时日志投递任务中的自定义日志字段。
 *
 * @method string getName() 获取从 HTTP 请求和响应中的指定位置提取数据，取值有：
<li>ReqHeader：从 HTTP 请求头中提取指定字段值；</li>
<li>RspHeader：从 HTTP 响应头中提取指定字段值；</li>
<li>Cookie: 从 Cookie 中提取指定字段值。</li>
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setName(string $Name) 设置从 HTTP 请求和响应中的指定位置提取数据，取值有：
<li>ReqHeader：从 HTTP 请求头中提取指定字段值；</li>
<li>RspHeader：从 HTTP 响应头中提取指定字段值；</li>
<li>Cookie: 从 Cookie 中提取指定字段值。</li>
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getValue() 获取需要提取值的参数名称，例如：Accept-Language。
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setValue(string $Value) 设置需要提取值的参数名称，例如：Accept-Language。
注意：此字段可能返回 null，表示取不到有效值。
 * @method boolean getEnabled() 获取是否投递该字段，不填表示不投递此字段。
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setEnabled(boolean $Enabled) 设置是否投递该字段，不填表示不投递此字段。
注意：此字段可能返回 null，表示取不到有效值。
 */
class CustomField extends AbstractModel
{
    /**
     * @var string 从 HTTP 请求和响应中的指定位置提取数据，取值有：
<li>ReqHeader：从 HTTP 请求头中提取指定字段值；</li>
<li>RspHeader：从 HTTP 响应头中提取指定字段值；</li>
<li>Cookie: 从 Cookie 中提取指定字段值。</li>
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Name;

    /**
     * @var string 需要提取值的参数名称，例如：Accept-Language。
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Value;

    /**
     * @var boolean 是否投递该字段，不填表示不投递此字段。
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Enabled;

    /**
     * @param string $Name 从 HTTP 请求和响应中的指定位置提取数据，取值有：
<li>ReqHeader：从 HTTP 请求头中提取指定字段值；</li>
<li>RspHeader：从 HTTP 响应头中提取指定字段值；</li>
<li>Cookie: 从 Cookie 中提取指定字段值。</li>
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Value 需要提取值的参数名称，例如：Accept-Language。
注意：此字段可能返回 null，表示取不到有效值。
     * @param boolean $Enabled 是否投递该字段，不填表示不投递此字段。
注意：此字段可能返回 null，表示取不到有效值。
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

        if (array_key_exists("Enabled",$param) and $param["Enabled"] !== null) {
            $this->Enabled = $param["Enabled"];
        }
    }
}
