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
namespace TencentCloud\Wedata\V20210820\Models;
use TencentCloud\Common\AbstractModel;

/**
 * BatchUpdateIntegrationTasks请求参数结构体
 *
 * @method array getTaskIds() 获取任务id
 * @method void setTaskIds(array $TaskIds) 设置任务id
 * @method string getIncharge() 获取责任人（多个责任人用小写分号隔开；离线任务传入的是账号名，实时任务传入的是账号id）
 * @method void setIncharge(string $Incharge) 设置责任人（多个责任人用小写分号隔开；离线任务传入的是账号名，实时任务传入的是账号id）
 * @method integer getTaskType() 获取任务类型
 * @method void setTaskType(integer $TaskType) 设置任务类型
 * @method string getProjectId() 获取项目id
 * @method void setProjectId(string $ProjectId) 设置项目id
 * @method string getInchargeIds() 获取责任人Id（多个责任人用小写分号隔开）
 * @method void setInchargeIds(string $InchargeIds) 设置责任人Id（多个责任人用小写分号隔开）
 * @method array getTaskNames() 获取本次批量操作涉及任务，用于审计
 * @method void setTaskNames(array $TaskNames) 设置本次批量操作涉及任务，用于审计
 */
class BatchUpdateIntegrationTasksRequest extends AbstractModel
{
    /**
     * @var array 任务id
     */
    public $TaskIds;

    /**
     * @var string 责任人（多个责任人用小写分号隔开；离线任务传入的是账号名，实时任务传入的是账号id）
     */
    public $Incharge;

    /**
     * @var integer 任务类型
     */
    public $TaskType;

    /**
     * @var string 项目id
     */
    public $ProjectId;

    /**
     * @var string 责任人Id（多个责任人用小写分号隔开）
     */
    public $InchargeIds;

    /**
     * @var array 本次批量操作涉及任务，用于审计
     */
    public $TaskNames;

    /**
     * @param array $TaskIds 任务id
     * @param string $Incharge 责任人（多个责任人用小写分号隔开；离线任务传入的是账号名，实时任务传入的是账号id）
     * @param integer $TaskType 任务类型
     * @param string $ProjectId 项目id
     * @param string $InchargeIds 责任人Id（多个责任人用小写分号隔开）
     * @param array $TaskNames 本次批量操作涉及任务，用于审计
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
        if (array_key_exists("TaskIds",$param) and $param["TaskIds"] !== null) {
            $this->TaskIds = $param["TaskIds"];
        }

        if (array_key_exists("Incharge",$param) and $param["Incharge"] !== null) {
            $this->Incharge = $param["Incharge"];
        }

        if (array_key_exists("TaskType",$param) and $param["TaskType"] !== null) {
            $this->TaskType = $param["TaskType"];
        }

        if (array_key_exists("ProjectId",$param) and $param["ProjectId"] !== null) {
            $this->ProjectId = $param["ProjectId"];
        }

        if (array_key_exists("InchargeIds",$param) and $param["InchargeIds"] !== null) {
            $this->InchargeIds = $param["InchargeIds"];
        }

        if (array_key_exists("TaskNames",$param) and $param["TaskNames"] !== null) {
            $this->TaskNames = $param["TaskNames"];
        }
    }
}
