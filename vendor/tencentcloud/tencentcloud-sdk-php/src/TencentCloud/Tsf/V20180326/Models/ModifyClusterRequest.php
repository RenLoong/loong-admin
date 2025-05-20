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
namespace TencentCloud\Tsf\V20180326\Models;
use TencentCloud\Common\AbstractModel;

/**
 * ModifyCluster请求参数结构体
 *
 * @method string getClusterId() 获取集群ID
 * @method void setClusterId(string $ClusterId) 设置集群ID
 * @method string getClusterName() 获取集群名称
 * @method void setClusterName(string $ClusterName) 设置集群名称
 * @method string getClusterDesc() 获取集群描述信息
 * @method void setClusterDesc(string $ClusterDesc) 设置集群描述信息
 * @method string getClusterRemarkName() 获取备注名
 * @method void setClusterRemarkName(string $ClusterRemarkName) 设置备注名
 * @method boolean getEnableLogCollection() 获取是否开启cls日志功能
 * @method void setEnableLogCollection(boolean $EnableLogCollection) 设置是否开启cls日志功能
 * @method boolean getRepairLog() 获取是否修复cls日志功能
 * @method void setRepairLog(boolean $RepairLog) 设置是否修复cls日志功能
 */
class ModifyClusterRequest extends AbstractModel
{
    /**
     * @var string 集群ID
     */
    public $ClusterId;

    /**
     * @var string 集群名称
     */
    public $ClusterName;

    /**
     * @var string 集群描述信息
     */
    public $ClusterDesc;

    /**
     * @var string 备注名
     */
    public $ClusterRemarkName;

    /**
     * @var boolean 是否开启cls日志功能
     */
    public $EnableLogCollection;

    /**
     * @var boolean 是否修复cls日志功能
     */
    public $RepairLog;

    /**
     * @param string $ClusterId 集群ID
     * @param string $ClusterName 集群名称
     * @param string $ClusterDesc 集群描述信息
     * @param string $ClusterRemarkName 备注名
     * @param boolean $EnableLogCollection 是否开启cls日志功能
     * @param boolean $RepairLog 是否修复cls日志功能
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
        if (array_key_exists("ClusterId",$param) and $param["ClusterId"] !== null) {
            $this->ClusterId = $param["ClusterId"];
        }

        if (array_key_exists("ClusterName",$param) and $param["ClusterName"] !== null) {
            $this->ClusterName = $param["ClusterName"];
        }

        if (array_key_exists("ClusterDesc",$param) and $param["ClusterDesc"] !== null) {
            $this->ClusterDesc = $param["ClusterDesc"];
        }

        if (array_key_exists("ClusterRemarkName",$param) and $param["ClusterRemarkName"] !== null) {
            $this->ClusterRemarkName = $param["ClusterRemarkName"];
        }

        if (array_key_exists("EnableLogCollection",$param) and $param["EnableLogCollection"] !== null) {
            $this->EnableLogCollection = $param["EnableLogCollection"];
        }

        if (array_key_exists("RepairLog",$param) and $param["RepairLog"] !== null) {
            $this->RepairLog = $param["RepairLog"];
        }
    }
}
