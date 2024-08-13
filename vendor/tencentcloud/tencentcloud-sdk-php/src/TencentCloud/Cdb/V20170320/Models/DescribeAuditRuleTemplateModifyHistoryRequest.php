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
namespace TencentCloud\Cdb\V20170320\Models;
use TencentCloud\Common\AbstractModel;

/**
 * DescribeAuditRuleTemplateModifyHistory请求参数结构体
 *
 * @method array getRuleTemplateIds() 获取模板ID
 * @method void setRuleTemplateIds(array $RuleTemplateIds) 设置模板ID
 * @method string getStartTime() 获取查询范围的开始时间。
 * @method void setStartTime(string $StartTime) 设置查询范围的开始时间。
 * @method string getEndTime() 获取查询范围的结束时间。
 * @method void setEndTime(string $EndTime) 设置查询范围的结束时间。
 * @method integer getLimit() 获取返回条数。
 * @method void setLimit(integer $Limit) 设置返回条数。
 * @method integer getOffset() 获取偏移量。
 * @method void setOffset(integer $Offset) 设置偏移量。
 * @method string getOrder() 获取排序方式。DESC-按修改时间倒排，ASC-正序。
 * @method void setOrder(string $Order) 设置排序方式。DESC-按修改时间倒排，ASC-正序。
 */
class DescribeAuditRuleTemplateModifyHistoryRequest extends AbstractModel
{
    /**
     * @var array 模板ID
     */
    public $RuleTemplateIds;

    /**
     * @var string 查询范围的开始时间。
     */
    public $StartTime;

    /**
     * @var string 查询范围的结束时间。
     */
    public $EndTime;

    /**
     * @var integer 返回条数。
     */
    public $Limit;

    /**
     * @var integer 偏移量。
     */
    public $Offset;

    /**
     * @var string 排序方式。DESC-按修改时间倒排，ASC-正序。
     */
    public $Order;

    /**
     * @param array $RuleTemplateIds 模板ID
     * @param string $StartTime 查询范围的开始时间。
     * @param string $EndTime 查询范围的结束时间。
     * @param integer $Limit 返回条数。
     * @param integer $Offset 偏移量。
     * @param string $Order 排序方式。DESC-按修改时间倒排，ASC-正序。
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
        if (array_key_exists("RuleTemplateIds",$param) and $param["RuleTemplateIds"] !== null) {
            $this->RuleTemplateIds = $param["RuleTemplateIds"];
        }

        if (array_key_exists("StartTime",$param) and $param["StartTime"] !== null) {
            $this->StartTime = $param["StartTime"];
        }

        if (array_key_exists("EndTime",$param) and $param["EndTime"] !== null) {
            $this->EndTime = $param["EndTime"];
        }

        if (array_key_exists("Limit",$param) and $param["Limit"] !== null) {
            $this->Limit = $param["Limit"];
        }

        if (array_key_exists("Offset",$param) and $param["Offset"] !== null) {
            $this->Offset = $param["Offset"];
        }

        if (array_key_exists("Order",$param) and $param["Order"] !== null) {
            $this->Order = $param["Order"];
        }
    }
}
