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
namespace TencentCloud\Emr\V20190103\Models;
use TencentCloud\Common\AbstractModel;

/**
 * StartStopServiceOrMonitor请求参数结构体
 *
 * @method string getInstanceId() 获取集群ID
 * @method void setInstanceId(string $InstanceId) 设置集群ID
 * @method string getOpType() 获取操作类型，当前支持
<li>StartService：启动服务</li>
<li>StopService：停止服务</li>
<li>StartMonitor：退出维护</li>
<li>StopMonitor：进入维护</li>
<li>RestartService：重启服务 如果操作类型选择重启服务 StrategyConfig操作策略则是必填项</li>
 * @method void setOpType(string $OpType) 设置操作类型，当前支持
<li>StartService：启动服务</li>
<li>StopService：停止服务</li>
<li>StartMonitor：退出维护</li>
<li>StopMonitor：进入维护</li>
<li>RestartService：重启服务 如果操作类型选择重启服务 StrategyConfig操作策略则是必填项</li>
 * @method OpScope getOpScope() 获取操作范围
 * @method void setOpScope(OpScope $OpScope) 设置操作范围
 * @method StrategyConfig getStrategyConfig() 获取操作策略
 * @method void setStrategyConfig(StrategyConfig $StrategyConfig) 设置操作策略
 * @method StopParams getStopParams() 获取暂停服务时用的参数
 * @method void setStopParams(StopParams $StopParams) 设置暂停服务时用的参数
 * @method boolean getKeepMonitorButNotRecoverProcess() 获取当OpType为<li>StopMonitor</li>才有用，true表示进入维护模式但是仍然监控进程但是不拉起进程
 * @method void setKeepMonitorButNotRecoverProcess(boolean $KeepMonitorButNotRecoverProcess) 设置当OpType为<li>StopMonitor</li>才有用，true表示进入维护模式但是仍然监控进程但是不拉起进程
 */
class StartStopServiceOrMonitorRequest extends AbstractModel
{
    /**
     * @var string 集群ID
     */
    public $InstanceId;

    /**
     * @var string 操作类型，当前支持
<li>StartService：启动服务</li>
<li>StopService：停止服务</li>
<li>StartMonitor：退出维护</li>
<li>StopMonitor：进入维护</li>
<li>RestartService：重启服务 如果操作类型选择重启服务 StrategyConfig操作策略则是必填项</li>
     */
    public $OpType;

    /**
     * @var OpScope 操作范围
     */
    public $OpScope;

    /**
     * @var StrategyConfig 操作策略
     */
    public $StrategyConfig;

    /**
     * @var StopParams 暂停服务时用的参数
     */
    public $StopParams;

    /**
     * @var boolean 当OpType为<li>StopMonitor</li>才有用，true表示进入维护模式但是仍然监控进程但是不拉起进程
     */
    public $KeepMonitorButNotRecoverProcess;

    /**
     * @param string $InstanceId 集群ID
     * @param string $OpType 操作类型，当前支持
<li>StartService：启动服务</li>
<li>StopService：停止服务</li>
<li>StartMonitor：退出维护</li>
<li>StopMonitor：进入维护</li>
<li>RestartService：重启服务 如果操作类型选择重启服务 StrategyConfig操作策略则是必填项</li>
     * @param OpScope $OpScope 操作范围
     * @param StrategyConfig $StrategyConfig 操作策略
     * @param StopParams $StopParams 暂停服务时用的参数
     * @param boolean $KeepMonitorButNotRecoverProcess 当OpType为<li>StopMonitor</li>才有用，true表示进入维护模式但是仍然监控进程但是不拉起进程
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

        if (array_key_exists("OpType",$param) and $param["OpType"] !== null) {
            $this->OpType = $param["OpType"];
        }

        if (array_key_exists("OpScope",$param) and $param["OpScope"] !== null) {
            $this->OpScope = new OpScope();
            $this->OpScope->deserialize($param["OpScope"]);
        }

        if (array_key_exists("StrategyConfig",$param) and $param["StrategyConfig"] !== null) {
            $this->StrategyConfig = new StrategyConfig();
            $this->StrategyConfig->deserialize($param["StrategyConfig"]);
        }

        if (array_key_exists("StopParams",$param) and $param["StopParams"] !== null) {
            $this->StopParams = new StopParams();
            $this->StopParams->deserialize($param["StopParams"]);
        }

        if (array_key_exists("KeepMonitorButNotRecoverProcess",$param) and $param["KeepMonitorButNotRecoverProcess"] !== null) {
            $this->KeepMonitorButNotRecoverProcess = $param["KeepMonitorButNotRecoverProcess"];
        }
    }
}
