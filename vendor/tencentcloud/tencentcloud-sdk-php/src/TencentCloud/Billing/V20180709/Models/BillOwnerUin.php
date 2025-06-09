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
namespace TencentCloud\Billing\V20180709\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 使用者 UIN筛选列表
 *
 * @method string getOwnerUin() 获取使用者 UIN：实际使用资源的账号 ID
 * @method void setOwnerUin(string $OwnerUin) 设置使用者 UIN：实际使用资源的账号 ID
 */
class BillOwnerUin extends AbstractModel
{
    /**
     * @var string 使用者 UIN：实际使用资源的账号 ID
     */
    public $OwnerUin;

    /**
     * @param string $OwnerUin 使用者 UIN：实际使用资源的账号 ID
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
        if (array_key_exists("OwnerUin",$param) and $param["OwnerUin"] !== null) {
            $this->OwnerUin = $param["OwnerUin"];
        }
    }
}
