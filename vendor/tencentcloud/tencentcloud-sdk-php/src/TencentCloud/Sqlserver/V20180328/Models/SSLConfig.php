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
namespace TencentCloud\Sqlserver\V20180328\Models;
use TencentCloud\Common\AbstractModel;

/**
 * SSL加密配置
 *
 * @method string getEncryption() 获取SSL加密状态，
enable-已开启
disable-未开启
enable_doing-开启中
disable_doing-关闭中
renew_doing-更新中
wait_doing-等待维护时间内执行
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setEncryption(string $Encryption) 设置SSL加密状态，
enable-已开启
disable-未开启
enable_doing-开启中
disable_doing-关闭中
renew_doing-更新中
wait_doing-等待维护时间内执行
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getSSLValidityPeriod() 获取SSL证书有效期，时间格式 YYYY-MM-DD HH:MM:SS
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setSSLValidityPeriod(string $SSLValidityPeriod) 设置SSL证书有效期，时间格式 YYYY-MM-DD HH:MM:SS
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getSSLValidity() 获取SSL证书有效性，0-无效，1-有效
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setSSLValidity(integer $SSLValidity) 设置SSL证书有效性，0-无效，1-有效
注意：此字段可能返回 null，表示取不到有效值。
 */
class SSLConfig extends AbstractModel
{
    /**
     * @var string SSL加密状态，
enable-已开启
disable-未开启
enable_doing-开启中
disable_doing-关闭中
renew_doing-更新中
wait_doing-等待维护时间内执行
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Encryption;

    /**
     * @var string SSL证书有效期，时间格式 YYYY-MM-DD HH:MM:SS
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $SSLValidityPeriod;

    /**
     * @var integer SSL证书有效性，0-无效，1-有效
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $SSLValidity;

    /**
     * @param string $Encryption SSL加密状态，
enable-已开启
disable-未开启
enable_doing-开启中
disable_doing-关闭中
renew_doing-更新中
wait_doing-等待维护时间内执行
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $SSLValidityPeriod SSL证书有效期，时间格式 YYYY-MM-DD HH:MM:SS
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $SSLValidity SSL证书有效性，0-无效，1-有效
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
        if (array_key_exists("Encryption",$param) and $param["Encryption"] !== null) {
            $this->Encryption = $param["Encryption"];
        }

        if (array_key_exists("SSLValidityPeriod",$param) and $param["SSLValidityPeriod"] !== null) {
            $this->SSLValidityPeriod = $param["SSLValidityPeriod"];
        }

        if (array_key_exists("SSLValidity",$param) and $param["SSLValidity"] !== null) {
            $this->SSLValidity = $param["SSLValidity"];
        }
    }
}
