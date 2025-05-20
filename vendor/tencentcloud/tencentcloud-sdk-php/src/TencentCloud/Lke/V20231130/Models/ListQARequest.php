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
namespace TencentCloud\Lke\V20231130\Models;
use TencentCloud\Common\AbstractModel;

/**
 * ListQA请求参数结构体
 *
 * @method string getBotBizId() 获取机器人ID
 * @method void setBotBizId(string $BotBizId) 设置机器人ID
 * @method integer getPageNumber() 获取页码
 * @method void setPageNumber(integer $PageNumber) 设置页码
 * @method integer getPageSize() 获取每页大小
 * @method void setPageSize(integer $PageSize) 设置每页大小
 * @method string getQuery() 获取查询问题
 * @method void setQuery(string $Query) 设置查询问题
 * @method array getAcceptStatus() 获取校验状态(1未校验2采纳3不采纳)
 * @method void setAcceptStatus(array $AcceptStatus) 设置校验状态(1未校验2采纳3不采纳)
 * @method array getReleaseStatus() 获取发布状态(2待发布 3发布中 4已发布 7审核中 8审核失败 9人工申述中 11人工申述失败)
 * @method void setReleaseStatus(array $ReleaseStatus) 设置发布状态(2待发布 3发布中 4已发布 7审核中 8审核失败 9人工申述中 11人工申述失败)
 * @method string getDocBizId() 获取文档ID
 * @method void setDocBizId(string $DocBizId) 设置文档ID
 * @method integer getSource() 获取来源(1 文档生成 2 批量导入 3 手动添加)
 * @method void setSource(integer $Source) 设置来源(1 文档生成 2 批量导入 3 手动添加)
 * @method string getQueryAnswer() 获取查询答案
 * @method void setQueryAnswer(string $QueryAnswer) 设置查询答案
 * @method array getQaBizIds() 获取QA业务ID列表
 * @method void setQaBizIds(array $QaBizIds) 设置QA业务ID列表
 */
class ListQARequest extends AbstractModel
{
    /**
     * @var string 机器人ID
     */
    public $BotBizId;

    /**
     * @var integer 页码
     */
    public $PageNumber;

    /**
     * @var integer 每页大小
     */
    public $PageSize;

    /**
     * @var string 查询问题
     */
    public $Query;

    /**
     * @var array 校验状态(1未校验2采纳3不采纳)
     */
    public $AcceptStatus;

    /**
     * @var array 发布状态(2待发布 3发布中 4已发布 7审核中 8审核失败 9人工申述中 11人工申述失败)
     */
    public $ReleaseStatus;

    /**
     * @var string 文档ID
     */
    public $DocBizId;

    /**
     * @var integer 来源(1 文档生成 2 批量导入 3 手动添加)
     */
    public $Source;

    /**
     * @var string 查询答案
     */
    public $QueryAnswer;

    /**
     * @var array QA业务ID列表
     */
    public $QaBizIds;

    /**
     * @param string $BotBizId 机器人ID
     * @param integer $PageNumber 页码
     * @param integer $PageSize 每页大小
     * @param string $Query 查询问题
     * @param array $AcceptStatus 校验状态(1未校验2采纳3不采纳)
     * @param array $ReleaseStatus 发布状态(2待发布 3发布中 4已发布 7审核中 8审核失败 9人工申述中 11人工申述失败)
     * @param string $DocBizId 文档ID
     * @param integer $Source 来源(1 文档生成 2 批量导入 3 手动添加)
     * @param string $QueryAnswer 查询答案
     * @param array $QaBizIds QA业务ID列表
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
        if (array_key_exists("BotBizId",$param) and $param["BotBizId"] !== null) {
            $this->BotBizId = $param["BotBizId"];
        }

        if (array_key_exists("PageNumber",$param) and $param["PageNumber"] !== null) {
            $this->PageNumber = $param["PageNumber"];
        }

        if (array_key_exists("PageSize",$param) and $param["PageSize"] !== null) {
            $this->PageSize = $param["PageSize"];
        }

        if (array_key_exists("Query",$param) and $param["Query"] !== null) {
            $this->Query = $param["Query"];
        }

        if (array_key_exists("AcceptStatus",$param) and $param["AcceptStatus"] !== null) {
            $this->AcceptStatus = $param["AcceptStatus"];
        }

        if (array_key_exists("ReleaseStatus",$param) and $param["ReleaseStatus"] !== null) {
            $this->ReleaseStatus = $param["ReleaseStatus"];
        }

        if (array_key_exists("DocBizId",$param) and $param["DocBizId"] !== null) {
            $this->DocBizId = $param["DocBizId"];
        }

        if (array_key_exists("Source",$param) and $param["Source"] !== null) {
            $this->Source = $param["Source"];
        }

        if (array_key_exists("QueryAnswer",$param) and $param["QueryAnswer"] !== null) {
            $this->QueryAnswer = $param["QueryAnswer"];
        }

        if (array_key_exists("QaBizIds",$param) and $param["QaBizIds"] !== null) {
            $this->QaBizIds = $param["QaBizIds"];
        }
    }
}
