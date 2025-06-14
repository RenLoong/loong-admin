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
namespace TencentCloud\Clb\V20180317\Models;
use TencentCloud\Common\AbstractModel;

/**
 * DeleteLoadBalancer请求参数结构体
 *
 * @method array getLoadBalancerIds() 获取要删除的负载均衡实例 ID 数组，可以通过 [DescribeLoadBalancers](https://cloud.tencent.com/document/product/214/30685) 接口获取，数组大小最大支持20。
 * @method void setLoadBalancerIds(array $LoadBalancerIds) 设置要删除的负载均衡实例 ID 数组，可以通过 [DescribeLoadBalancers](https://cloud.tencent.com/document/product/214/30685) 接口获取，数组大小最大支持20。
 * @method boolean getForceDelete() 获取是否强制删除clb。True表示强制删除，False表示不是强制删除，需要做拦截校验。
默认为 False
 * @method void setForceDelete(boolean $ForceDelete) 设置是否强制删除clb。True表示强制删除，False表示不是强制删除，需要做拦截校验。
默认为 False
 */
class DeleteLoadBalancerRequest extends AbstractModel
{
    /**
     * @var array 要删除的负载均衡实例 ID 数组，可以通过 [DescribeLoadBalancers](https://cloud.tencent.com/document/product/214/30685) 接口获取，数组大小最大支持20。
     */
    public $LoadBalancerIds;

    /**
     * @var boolean 是否强制删除clb。True表示强制删除，False表示不是强制删除，需要做拦截校验。
默认为 False
     */
    public $ForceDelete;

    /**
     * @param array $LoadBalancerIds 要删除的负载均衡实例 ID 数组，可以通过 [DescribeLoadBalancers](https://cloud.tencent.com/document/product/214/30685) 接口获取，数组大小最大支持20。
     * @param boolean $ForceDelete 是否强制删除clb。True表示强制删除，False表示不是强制删除，需要做拦截校验。
默认为 False
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
        if (array_key_exists("LoadBalancerIds",$param) and $param["LoadBalancerIds"] !== null) {
            $this->LoadBalancerIds = $param["LoadBalancerIds"];
        }

        if (array_key_exists("ForceDelete",$param) and $param["ForceDelete"] !== null) {
            $this->ForceDelete = $param["ForceDelete"];
        }
    }
}
