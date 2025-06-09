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
namespace TencentCloud\Es\V20180416\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 智能运维指标详情
 *
 * @method string getKey() 获取指标详情名
 * @method void setKey(string $Key) 设置指标详情名
 * @method array getMetrics() 获取指标详情值
 * @method void setMetrics(array $Metrics) 设置指标详情值
 */
class MetricDetail extends AbstractModel
{
    /**
     * @var string 指标详情名
     */
    public $Key;

    /**
     * @var array 指标详情值
     */
    public $Metrics;

    /**
     * @param string $Key 指标详情名
     * @param array $Metrics 指标详情值
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
        if (array_key_exists("Key",$param) and $param["Key"] !== null) {
            $this->Key = $param["Key"];
        }

        if (array_key_exists("Metrics",$param) and $param["Metrics"] !== null) {
            $this->Metrics = [];
            foreach ($param["Metrics"] as $key => $value){
                $obj = new Metric();
                $obj->deserialize($value);
                array_push($this->Metrics, $obj);
            }
        }
    }
}
