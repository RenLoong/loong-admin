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
 * DescribeCollationTimeZone请求参数结构体
 *
 * @method string getMachineType() 获取购买实例的宿主机类型，PM-物理机, CLOUD_PREMIUM-云服务器高性能云盘，
CLOUD_SSD-云服务器SSD云盘,CLOUD_HSSD-云服务器加强型SSD云盘，CLOUD_TSSD-云服务器极速型SSD云盘，CLOUD_BSSD-云服务器通用型SSD云盘,CLOUD_BASIC-云服务器云硬盘，默认取值PM
 * @method void setMachineType(string $MachineType) 设置购买实例的宿主机类型，PM-物理机, CLOUD_PREMIUM-云服务器高性能云盘，
CLOUD_SSD-云服务器SSD云盘,CLOUD_HSSD-云服务器加强型SSD云盘，CLOUD_TSSD-云服务器极速型SSD云盘，CLOUD_BSSD-云服务器通用型SSD云盘,CLOUD_BASIC-云服务器云硬盘，默认取值PM
 * @method string getDBVersion() 获取购买实例版本号
 * @method void setDBVersion(string $DBVersion) 设置购买实例版本号
 */
class DescribeCollationTimeZoneRequest extends AbstractModel
{
    /**
     * @var string 购买实例的宿主机类型，PM-物理机, CLOUD_PREMIUM-云服务器高性能云盘，
CLOUD_SSD-云服务器SSD云盘,CLOUD_HSSD-云服务器加强型SSD云盘，CLOUD_TSSD-云服务器极速型SSD云盘，CLOUD_BSSD-云服务器通用型SSD云盘,CLOUD_BASIC-云服务器云硬盘，默认取值PM
     */
    public $MachineType;

    /**
     * @var string 购买实例版本号
     */
    public $DBVersion;

    /**
     * @param string $MachineType 购买实例的宿主机类型，PM-物理机, CLOUD_PREMIUM-云服务器高性能云盘，
CLOUD_SSD-云服务器SSD云盘,CLOUD_HSSD-云服务器加强型SSD云盘，CLOUD_TSSD-云服务器极速型SSD云盘，CLOUD_BSSD-云服务器通用型SSD云盘,CLOUD_BASIC-云服务器云硬盘，默认取值PM
     * @param string $DBVersion 购买实例版本号
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
        if (array_key_exists("MachineType",$param) and $param["MachineType"] !== null) {
            $this->MachineType = $param["MachineType"];
        }

        if (array_key_exists("DBVersion",$param) and $param["DBVersion"] !== null) {
            $this->DBVersion = $param["DBVersion"];
        }
    }
}
