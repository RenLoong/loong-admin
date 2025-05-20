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
namespace TencentCloud\Aiart\V20221229\Models;
use TencentCloud\Common\AbstractModel;

/**
 * QueryDrawPortraitJob返回参数结构体
 *
 * @method string getJobStatusCode() 获取任务状态码。
INIT: 初始化、WAIT：等待中、RUN：运行中、FAIL：处理失败、DONE：处理完成。
 * @method void setJobStatusCode(string $JobStatusCode) 设置任务状态码。
INIT: 初始化、WAIT：等待中、RUN：运行中、FAIL：处理失败、DONE：处理完成。
 * @method string getJobStatusMsg() 获取任务状态信息。
 * @method void setJobStatusMsg(string $JobStatusMsg) 设置任务状态信息。
 * @method string getJobErrorCode() 获取任务错误码。
 * @method void setJobErrorCode(string $JobErrorCode) 设置任务错误码。
 * @method string getJobErrorMsg() 获取任务错误信息。
 * @method void setJobErrorMsg(string $JobErrorMsg) 设置任务错误信息。
 * @method array getResultUrls() 获取结果 URL 数组。
URL 有效期1小时，请及时保存。
 * @method void setResultUrls(array $ResultUrls) 设置结果 URL 数组。
URL 有效期1小时，请及时保存。
 * @method array getResultDetails() 获取结果描述数组。
 * @method void setResultDetails(array $ResultDetails) 设置结果描述数组。
 * @method string getRequestId() 获取唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
 * @method void setRequestId(string $RequestId) 设置唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
 */
class QueryDrawPortraitJobResponse extends AbstractModel
{
    /**
     * @var string 任务状态码。
INIT: 初始化、WAIT：等待中、RUN：运行中、FAIL：处理失败、DONE：处理完成。
     */
    public $JobStatusCode;

    /**
     * @var string 任务状态信息。
     */
    public $JobStatusMsg;

    /**
     * @var string 任务错误码。
     */
    public $JobErrorCode;

    /**
     * @var string 任务错误信息。
     */
    public $JobErrorMsg;

    /**
     * @var array 结果 URL 数组。
URL 有效期1小时，请及时保存。
     */
    public $ResultUrls;

    /**
     * @var array 结果描述数组。
     */
    public $ResultDetails;

    /**
     * @var string 唯一请求 ID，由服务端生成，每次请求都会返回（若请求因其他原因未能抵达服务端，则该次请求不会获得 RequestId）。定位问题时需要提供该次请求的 RequestId。
     */
    public $RequestId;

    /**
     * @param string $JobStatusCode 任务状态码。
INIT: 初始化、WAIT：等待中、RUN：运行中、FAIL：处理失败、DONE：处理完成。
     * @param string $JobStatusMsg 任务状态信息。
     * @param string $JobErrorCode 任务错误码。
     * @param string $JobErrorMsg 任务错误信息。
     * @param array $ResultUrls 结果 URL 数组。
URL 有效期1小时，请及时保存。
     * @param array $ResultDetails 结果描述数组。
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
        if (array_key_exists("JobStatusCode",$param) and $param["JobStatusCode"] !== null) {
            $this->JobStatusCode = $param["JobStatusCode"];
        }

        if (array_key_exists("JobStatusMsg",$param) and $param["JobStatusMsg"] !== null) {
            $this->JobStatusMsg = $param["JobStatusMsg"];
        }

        if (array_key_exists("JobErrorCode",$param) and $param["JobErrorCode"] !== null) {
            $this->JobErrorCode = $param["JobErrorCode"];
        }

        if (array_key_exists("JobErrorMsg",$param) and $param["JobErrorMsg"] !== null) {
            $this->JobErrorMsg = $param["JobErrorMsg"];
        }

        if (array_key_exists("ResultUrls",$param) and $param["ResultUrls"] !== null) {
            $this->ResultUrls = $param["ResultUrls"];
        }

        if (array_key_exists("ResultDetails",$param) and $param["ResultDetails"] !== null) {
            $this->ResultDetails = $param["ResultDetails"];
        }

        if (array_key_exists("RequestId",$param) and $param["RequestId"] !== null) {
            $this->RequestId = $param["RequestId"];
        }
    }
}
