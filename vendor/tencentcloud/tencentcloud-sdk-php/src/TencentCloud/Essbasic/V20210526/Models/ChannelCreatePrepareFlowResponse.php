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
namespace TencentCloud\Essbasic\V20210526\Models;
use TencentCloud\Common\AbstractModel;

/**
 * ChannelCreatePrepareFlow返回参数结构体
 *
 * @method string getPrepareFlowUrl() 获取发起的合同嵌入链接， 可以直接点击进入进行合同发起， 有效期为5分钟
 * @method void setPrepareFlowUrl(string $PrepareFlowUrl) 设置发起的合同嵌入链接， 可以直接点击进入进行合同发起， 有效期为5分钟
 * @method string getPreviewFlowUrl() 获取合同发起后预览链接， 注意此时合同并未发起，仅只是展示效果， 有效期为5分钟
 * @method void setPreviewFlowUrl(string $PreviewFlowUrl) 设置合同发起后预览链接， 注意此时合同并未发起，仅只是展示效果， 有效期为5分钟
 * @method string getFlowId() 获取发起的合同临时Id， 只有当点击进入链接，成功发起合同后， 此Id才有效
 * @method void setFlowId(string $FlowId) 设置发起的合同临时Id， 只有当点击进入链接，成功发起合同后， 此Id才有效
 * @method string getRequestId() 获取唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
 * @method void setRequestId(string $RequestId) 设置唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
 */
class ChannelCreatePrepareFlowResponse extends AbstractModel
{
    /**
     * @var string 发起的合同嵌入链接， 可以直接点击进入进行合同发起， 有效期为5分钟
     */
    public $PrepareFlowUrl;

    /**
     * @var string 合同发起后预览链接， 注意此时合同并未发起，仅只是展示效果， 有效期为5分钟
     */
    public $PreviewFlowUrl;

    /**
     * @var string 发起的合同临时Id， 只有当点击进入链接，成功发起合同后， 此Id才有效
     */
    public $FlowId;

    /**
     * @var string 唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
     */
    public $RequestId;

    /**
     * @param string $PrepareFlowUrl 发起的合同嵌入链接， 可以直接点击进入进行合同发起， 有效期为5分钟
     * @param string $PreviewFlowUrl 合同发起后预览链接， 注意此时合同并未发起，仅只是展示效果， 有效期为5分钟
     * @param string $FlowId 发起的合同临时Id， 只有当点击进入链接，成功发起合同后， 此Id才有效
     * @param string $RequestId 唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
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
        if (array_key_exists("PrepareFlowUrl",$param) and $param["PrepareFlowUrl"] !== null) {
            $this->PrepareFlowUrl = $param["PrepareFlowUrl"];
        }

        if (array_key_exists("PreviewFlowUrl",$param) and $param["PreviewFlowUrl"] !== null) {
            $this->PreviewFlowUrl = $param["PreviewFlowUrl"];
        }

        if (array_key_exists("FlowId",$param) and $param["FlowId"] !== null) {
            $this->FlowId = $param["FlowId"];
        }

        if (array_key_exists("RequestId",$param) and $param["RequestId"] !== null) {
            $this->RequestId = $param["RequestId"];
        }
    }
}
