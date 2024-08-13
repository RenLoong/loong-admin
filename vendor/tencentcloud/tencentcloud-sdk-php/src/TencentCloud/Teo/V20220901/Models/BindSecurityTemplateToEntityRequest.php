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
 * BindSecurityTemplateToEntity请求参数结构体
 *
 * @method string getZoneId() 获取需要绑定或解绑的策略模板所属站点 ID。
 * @method void setZoneId(string $ZoneId) 设置需要绑定或解绑的策略模板所属站点 ID。
 * @method array getEntities() 获取绑定至策略模板（或者从策略模板解绑）的域名列表。
 * @method void setEntities(array $Entities) 设置绑定至策略模板（或者从策略模板解绑）的域名列表。
 * @method string getOperate() 获取绑定或解绑操作选项，取值有：
<li>bind：绑定域名至策略模板；</li>
<li>unbind-keep-policy：将域名从策略模板解绑，解绑时保留当前策略；</li>
<li>unbind-use-default：将域名从策略模板解绑，并使用默认空白策略。</li>注意：解绑操作当前仅支持单个域名解绑。即：当 Operate 参数取值为 unbind-keep-policy 或 unbind-use-default 时，Entities 参数列表仅支持填写一个域名。
 * @method void setOperate(string $Operate) 设置绑定或解绑操作选项，取值有：
<li>bind：绑定域名至策略模板；</li>
<li>unbind-keep-policy：将域名从策略模板解绑，解绑时保留当前策略；</li>
<li>unbind-use-default：将域名从策略模板解绑，并使用默认空白策略。</li>注意：解绑操作当前仅支持单个域名解绑。即：当 Operate 参数取值为 unbind-keep-policy 或 unbind-use-default 时，Entities 参数列表仅支持填写一个域名。
 * @method string getTemplateId() 获取指定绑定或解绑的策略模板 ID 。
 * @method void setTemplateId(string $TemplateId) 设置指定绑定或解绑的策略模板 ID 。
 * @method boolean getOverWrite() 获取如指定的域名已经绑定了策略模板，是否替换该模板。支持下列取值：
<li>true： 替换域名当前绑定的模板；</li>
<li>false：不替换域名当前绑定的模板。</li>注意：当选择不替换已有策略模板时，若指定域名已经绑定策略模板，API 将返回错误。
 * @method void setOverWrite(boolean $OverWrite) 设置如指定的域名已经绑定了策略模板，是否替换该模板。支持下列取值：
<li>true： 替换域名当前绑定的模板；</li>
<li>false：不替换域名当前绑定的模板。</li>注意：当选择不替换已有策略模板时，若指定域名已经绑定策略模板，API 将返回错误。
 */
class BindSecurityTemplateToEntityRequest extends AbstractModel
{
    /**
     * @var string 需要绑定或解绑的策略模板所属站点 ID。
     */
    public $ZoneId;

    /**
     * @var array 绑定至策略模板（或者从策略模板解绑）的域名列表。
     */
    public $Entities;

    /**
     * @var string 绑定或解绑操作选项，取值有：
<li>bind：绑定域名至策略模板；</li>
<li>unbind-keep-policy：将域名从策略模板解绑，解绑时保留当前策略；</li>
<li>unbind-use-default：将域名从策略模板解绑，并使用默认空白策略。</li>注意：解绑操作当前仅支持单个域名解绑。即：当 Operate 参数取值为 unbind-keep-policy 或 unbind-use-default 时，Entities 参数列表仅支持填写一个域名。
     */
    public $Operate;

    /**
     * @var string 指定绑定或解绑的策略模板 ID 。
     */
    public $TemplateId;

    /**
     * @var boolean 如指定的域名已经绑定了策略模板，是否替换该模板。支持下列取值：
<li>true： 替换域名当前绑定的模板；</li>
<li>false：不替换域名当前绑定的模板。</li>注意：当选择不替换已有策略模板时，若指定域名已经绑定策略模板，API 将返回错误。
     */
    public $OverWrite;

    /**
     * @param string $ZoneId 需要绑定或解绑的策略模板所属站点 ID。
     * @param array $Entities 绑定至策略模板（或者从策略模板解绑）的域名列表。
     * @param string $Operate 绑定或解绑操作选项，取值有：
<li>bind：绑定域名至策略模板；</li>
<li>unbind-keep-policy：将域名从策略模板解绑，解绑时保留当前策略；</li>
<li>unbind-use-default：将域名从策略模板解绑，并使用默认空白策略。</li>注意：解绑操作当前仅支持单个域名解绑。即：当 Operate 参数取值为 unbind-keep-policy 或 unbind-use-default 时，Entities 参数列表仅支持填写一个域名。
     * @param string $TemplateId 指定绑定或解绑的策略模板 ID 。
     * @param boolean $OverWrite 如指定的域名已经绑定了策略模板，是否替换该模板。支持下列取值：
<li>true： 替换域名当前绑定的模板；</li>
<li>false：不替换域名当前绑定的模板。</li>注意：当选择不替换已有策略模板时，若指定域名已经绑定策略模板，API 将返回错误。
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
        if (array_key_exists("ZoneId",$param) and $param["ZoneId"] !== null) {
            $this->ZoneId = $param["ZoneId"];
        }

        if (array_key_exists("Entities",$param) and $param["Entities"] !== null) {
            $this->Entities = $param["Entities"];
        }

        if (array_key_exists("Operate",$param) and $param["Operate"] !== null) {
            $this->Operate = $param["Operate"];
        }

        if (array_key_exists("TemplateId",$param) and $param["TemplateId"] !== null) {
            $this->TemplateId = $param["TemplateId"];
        }

        if (array_key_exists("OverWrite",$param) and $param["OverWrite"] !== null) {
            $this->OverWrite = $param["OverWrite"];
        }
    }
}
