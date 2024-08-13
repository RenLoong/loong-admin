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
 * 批量修复漏洞二次弹窗
 *
 * @method string getHostName() 获取主机名
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setHostName(string $HostName) 设置主机名
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getHostIp() 获取主机ip
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setHostIp(string $HostIp) 设置主机ip
注意：此字段可能返回 null，表示取不到有效值。
 * @method array getTags() 获取主机标签
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setTags(array $Tags) 设置主机标签
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getQuuid() 获取主机quuid
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setQuuid(string $Quuid) 设置主机quuid
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getIsSupportAutoFix() 获取0 :漏洞不可自动修复，  1：可自动修复， 2：客户端已离线， 3：主机不是旗舰版只能手动修复， 4：机型不允许 ，5：修复中 ，6：已修复， 7：检测中, 9:修复失败, 10:已忽略 ,11:漏洞只支持linux不支持Windows, 12：漏洞只支持Windows不支持linux
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setIsSupportAutoFix(integer $IsSupportAutoFix) 设置0 :漏洞不可自动修复，  1：可自动修复， 2：客户端已离线， 3：主机不是旗舰版只能手动修复， 4：机型不允许 ，5：修复中 ，6：已修复， 7：检测中, 9:修复失败, 10:已忽略 ,11:漏洞只支持linux不支持Windows, 12：漏洞只支持Windows不支持linux
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getUuid() 获取主机uuid
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setUuid(string $Uuid) 设置主机uuid
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getInstanceId() 获取主机InstanceId
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInstanceId(string $InstanceId) 设置主机InstanceId
注意：此字段可能返回 null，表示取不到有效值。
 */
class VulInfoHostInfo extends AbstractModel
{
    /**
     * @var string 主机名
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $HostName;

    /**
     * @var string 主机ip
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $HostIp;

    /**
     * @var array 主机标签
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Tags;

    /**
     * @var string 主机quuid
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Quuid;

    /**
     * @var integer 0 :漏洞不可自动修复，  1：可自动修复， 2：客户端已离线， 3：主机不是旗舰版只能手动修复， 4：机型不允许 ，5：修复中 ，6：已修复， 7：检测中, 9:修复失败, 10:已忽略 ,11:漏洞只支持linux不支持Windows, 12：漏洞只支持Windows不支持linux
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $IsSupportAutoFix;

    /**
     * @var string 主机uuid
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Uuid;

    /**
     * @var string 主机InstanceId
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InstanceId;

    /**
     * @param string $HostName 主机名
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $HostIp 主机ip
注意：此字段可能返回 null，表示取不到有效值。
     * @param array $Tags 主机标签
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Quuid 主机quuid
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $IsSupportAutoFix 0 :漏洞不可自动修复，  1：可自动修复， 2：客户端已离线， 3：主机不是旗舰版只能手动修复， 4：机型不允许 ，5：修复中 ，6：已修复， 7：检测中, 9:修复失败, 10:已忽略 ,11:漏洞只支持linux不支持Windows, 12：漏洞只支持Windows不支持linux
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Uuid 主机uuid
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $InstanceId 主机InstanceId
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
        if (array_key_exists("HostName",$param) and $param["HostName"] !== null) {
            $this->HostName = $param["HostName"];
        }

        if (array_key_exists("HostIp",$param) and $param["HostIp"] !== null) {
            $this->HostIp = $param["HostIp"];
        }

        if (array_key_exists("Tags",$param) and $param["Tags"] !== null) {
            $this->Tags = $param["Tags"];
        }

        if (array_key_exists("Quuid",$param) and $param["Quuid"] !== null) {
            $this->Quuid = $param["Quuid"];
        }

        if (array_key_exists("IsSupportAutoFix",$param) and $param["IsSupportAutoFix"] !== null) {
            $this->IsSupportAutoFix = $param["IsSupportAutoFix"];
        }

        if (array_key_exists("Uuid",$param) and $param["Uuid"] !== null) {
            $this->Uuid = $param["Uuid"];
        }

        if (array_key_exists("InstanceId",$param) and $param["InstanceId"] !== null) {
            $this->InstanceId = $param["InstanceId"];
        }
    }
}
