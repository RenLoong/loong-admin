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
namespace TencentCloud\Cynosdb\V20190107\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 实例日志投递信息
 *
 * @method string getInstanceId() 获取实例id
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInstanceId(string $InstanceId) 设置实例id
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getInstanceName() 获取实例name

注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInstanceName(string $InstanceName) 设置实例name

注意：此字段可能返回 null，表示取不到有效值。
 * @method string getTopicId() 获取日志主题id

注意：此字段可能返回 null，表示取不到有效值。
 * @method void setTopicId(string $TopicId) 设置日志主题id

注意：此字段可能返回 null，表示取不到有效值。
 * @method string getTopicName() 获取日志主题name
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setTopicName(string $TopicName) 设置日志主题name
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getGroupId() 获取日志集id

注意：此字段可能返回 null，表示取不到有效值。
 * @method void setGroupId(string $GroupId) 设置日志集id

注意：此字段可能返回 null，表示取不到有效值。
 * @method string getGroupName() 获取日志集name

注意：此字段可能返回 null，表示取不到有效值。
 * @method void setGroupName(string $GroupName) 设置日志集name

注意：此字段可能返回 null，表示取不到有效值。
 * @method string getRegion() 获取日志投递地域

注意：此字段可能返回 null，表示取不到有效值。
 * @method void setRegion(string $Region) 设置日志投递地域

注意：此字段可能返回 null，表示取不到有效值。
 * @method string getStatus() 获取投递状态creating,running,offlining,offlined

注意：此字段可能返回 null，表示取不到有效值。
 * @method void setStatus(string $Status) 设置投递状态creating,running,offlining,offlined

注意：此字段可能返回 null，表示取不到有效值。
 */
class InstanceCLSDeliveryInfo extends AbstractModel
{
    /**
     * @var string 实例id
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InstanceId;

    /**
     * @var string 实例name

注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InstanceName;

    /**
     * @var string 日志主题id

注意：此字段可能返回 null，表示取不到有效值。
     */
    public $TopicId;

    /**
     * @var string 日志主题name
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $TopicName;

    /**
     * @var string 日志集id

注意：此字段可能返回 null，表示取不到有效值。
     */
    public $GroupId;

    /**
     * @var string 日志集name

注意：此字段可能返回 null，表示取不到有效值。
     */
    public $GroupName;

    /**
     * @var string 日志投递地域

注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Region;

    /**
     * @var string 投递状态creating,running,offlining,offlined

注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Status;

    /**
     * @param string $InstanceId 实例id
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $InstanceName 实例name

注意：此字段可能返回 null，表示取不到有效值。
     * @param string $TopicId 日志主题id

注意：此字段可能返回 null，表示取不到有效值。
     * @param string $TopicName 日志主题name
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $GroupId 日志集id

注意：此字段可能返回 null，表示取不到有效值。
     * @param string $GroupName 日志集name

注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Region 日志投递地域

注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Status 投递状态creating,running,offlining,offlined

注意：此字段可能返回 null，表示取不到有效值。
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
        if (array_key_exists("InstanceId",$param) and $param["InstanceId"] !== null) {
            $this->InstanceId = $param["InstanceId"];
        }

        if (array_key_exists("InstanceName",$param) and $param["InstanceName"] !== null) {
            $this->InstanceName = $param["InstanceName"];
        }

        if (array_key_exists("TopicId",$param) and $param["TopicId"] !== null) {
            $this->TopicId = $param["TopicId"];
        }

        if (array_key_exists("TopicName",$param) and $param["TopicName"] !== null) {
            $this->TopicName = $param["TopicName"];
        }

        if (array_key_exists("GroupId",$param) and $param["GroupId"] !== null) {
            $this->GroupId = $param["GroupId"];
        }

        if (array_key_exists("GroupName",$param) and $param["GroupName"] !== null) {
            $this->GroupName = $param["GroupName"];
        }

        if (array_key_exists("Region",$param) and $param["Region"] !== null) {
            $this->Region = $param["Region"];
        }

        if (array_key_exists("Status",$param) and $param["Status"] !== null) {
            $this->Status = $param["Status"];
        }
    }
}
