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
namespace TencentCloud\Ioa\V20220601\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 业务响应数据
 *
 * @method integer getId() 获取设备ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setId(integer $Id) 设置设备ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getMid() 获取设备唯一标识符
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setMid(string $Mid) 设置设备唯一标识符
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getName() 获取终端名（设备名）
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setName(string $Name) 设置终端名（设备名）
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getGroupId() 获取设备所在分组ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setGroupId(integer $GroupId) 设置设备所在分组ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getOsType() 获取OS平台(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setOsType(integer $OsType) 设置OS平台(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getIp() 获取设备IP地址（出口IP）
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setIp(string $Ip) 设置设备IP地址（出口IP）
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getOnlineStatus() 获取在线状态 2 在线 0，1 离线(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setOnlineStatus(integer $OnlineStatus) 设置在线状态 2 在线 0，1 离线(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getVersion() 获取客户端版本号-大整数
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setVersion(string $Version) 设置客户端版本号-大整数
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getStrVersion() 获取客户端版本号-点分字符串
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setStrVersion(string $StrVersion) 设置客户端版本号-点分字符串
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getItime() 获取首次在线时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setItime(string $Itime) 设置首次在线时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getConnActiveTime() 获取最后一次在线时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setConnActiveTime(string $ConnActiveTime) 设置最后一次在线时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getLocked() 获取设备是否加锁 1 锁定 0 2 非锁定(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setLocked(integer $Locked) 设置设备是否加锁 1 锁定 0 2 非锁定(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getLocalIpList() 获取设备本地IP列表, 包括IP
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setLocalIpList(string $LocalIpList) 设置设备本地IP列表, 包括IP
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getHostId() 获取主机ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setHostId(integer $HostId) 设置主机ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getGroupName() 获取设备所属分组名
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setGroupName(string $GroupName) 设置设备所属分组名
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getGroupNamePath() 获取设备所属分组路径
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setGroupNamePath(string $GroupNamePath) 设置设备所属分组路径
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getCriticalVulListCount() 获取未修复高危漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setCriticalVulListCount(integer $CriticalVulListCount) 设置未修复高危漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getComputerName() 获取设备名 和Name相同，保留参数
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setComputerName(string $ComputerName) 设置设备名 和Name相同，保留参数
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getDomainName() 获取登录域名
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDomainName(string $DomainName) 设置登录域名
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getMacAddr() 获取MAC地址
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setMacAddr(string $MacAddr) 设置MAC地址
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getVulCount() 获取漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setVulCount(integer $VulCount) 设置漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getRiskCount() 获取病毒风险数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setRiskCount(integer $RiskCount) 设置病毒风险数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getVirusVer() 获取病毒库版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setVirusVer(string $VirusVer) 设置病毒库版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getVulVersion() 获取漏洞库版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setVulVersion(string $VulVersion) 设置漏洞库版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getSysRepVersion() 获取系统修复引擎版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setSysRepVersion(string $SysRepVersion) 设置系统修复引擎版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method array getVulCriticalList() 获取高危补丁列表
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setVulCriticalList(array $VulCriticalList) 设置高危补丁列表
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getTags() 获取标签
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setTags(string $Tags) 设置标签
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getUserName() 获取终端用户名
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setUserName(string $UserName) 设置终端用户名
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getFirewallStatus() 获取防火墙状态(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setFirewallStatus(integer $FirewallStatus) 设置防火墙状态(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getSerialNum() 获取SN序列号
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setSerialNum(string $SerialNum) 设置SN序列号
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getDeviceStrategyVer() 获取设备管控策略版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDeviceStrategyVer(string $DeviceStrategyVer) 设置设备管控策略版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getNGNStrategyVer() 获取NGN策略版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setNGNStrategyVer(string $NGNStrategyVer) 设置NGN策略版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getIOAUserName() 获取最近登录账号
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setIOAUserName(string $IOAUserName) 设置最近登录账号
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getDeviceNewStrategyVer() 获取设备管控新策略
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDeviceNewStrategyVer(string $DeviceNewStrategyVer) 设置设备管控新策略
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getNGNNewStrategyVer() 获取NGN策略新版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setNGNNewStrategyVer(string $NGNNewStrategyVer) 设置NGN策略新版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getHostName() 获取主机名称
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setHostName(string $HostName) 设置主机名称
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getBaseBoardSn() 获取主板序列号
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setBaseBoardSn(string $BaseBoardSn) 设置主板序列号
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getAccountUsers() 获取绑定账户只有名字
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setAccountUsers(string $AccountUsers) 设置绑定账户只有名字
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getIdentityStrategyVer() 获取身份策略版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setIdentityStrategyVer(string $IdentityStrategyVer) 设置身份策略版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getIdentityNewStrategyVer() 获取身份策略新版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setIdentityNewStrategyVer(string $IdentityNewStrategyVer) 设置身份策略新版本
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getAccountGroupName() 获取最近登录账号部门
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setAccountGroupName(string $AccountGroupName) 设置最近登录账号部门
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getAccountName() 获取登录账号姓名
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setAccountName(string $AccountName) 设置登录账号姓名
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getAccountGroupId() 获取账号组id
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setAccountGroupId(integer $AccountGroupId) 设置账号组id
注意：此字段可能返回 null，表示取不到有效值。
 */
class DeviceDetail extends AbstractModel
{
    /**
     * @var integer 设备ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Id;

    /**
     * @var string 设备唯一标识符
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Mid;

    /**
     * @var string 终端名（设备名）
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Name;

    /**
     * @var integer 设备所在分组ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $GroupId;

    /**
     * @var integer OS平台(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $OsType;

    /**
     * @var string 设备IP地址（出口IP）
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Ip;

    /**
     * @var integer 在线状态 2 在线 0，1 离线(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $OnlineStatus;

    /**
     * @var string 客户端版本号-大整数
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Version;

    /**
     * @var string 客户端版本号-点分字符串
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $StrVersion;

    /**
     * @var string 首次在线时间
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Itime;

    /**
     * @var string 最后一次在线时间
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $ConnActiveTime;

    /**
     * @var integer 设备是否加锁 1 锁定 0 2 非锁定(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Locked;

    /**
     * @var string 设备本地IP列表, 包括IP
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $LocalIpList;

    /**
     * @var integer 主机ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $HostId;

    /**
     * @var string 设备所属分组名
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $GroupName;

    /**
     * @var string 设备所属分组路径
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $GroupNamePath;

    /**
     * @var integer 未修复高危漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $CriticalVulListCount;

    /**
     * @var string 设备名 和Name相同，保留参数
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $ComputerName;

    /**
     * @var string 登录域名
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DomainName;

    /**
     * @var string MAC地址
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $MacAddr;

    /**
     * @var integer 漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $VulCount;

    /**
     * @var integer 病毒风险数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $RiskCount;

    /**
     * @var string 病毒库版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $VirusVer;

    /**
     * @var string 漏洞库版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $VulVersion;

    /**
     * @var string 系统修复引擎版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $SysRepVersion;

    /**
     * @var array 高危补丁列表
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $VulCriticalList;

    /**
     * @var string 标签
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Tags;

    /**
     * @var string 终端用户名
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $UserName;

    /**
     * @var integer 防火墙状态(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $FirewallStatus;

    /**
     * @var string SN序列号
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $SerialNum;

    /**
     * @var string 设备管控策略版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DeviceStrategyVer;

    /**
     * @var string NGN策略版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $NGNStrategyVer;

    /**
     * @var string 最近登录账号
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $IOAUserName;

    /**
     * @var string 设备管控新策略
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DeviceNewStrategyVer;

    /**
     * @var string NGN策略新版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $NGNNewStrategyVer;

    /**
     * @var string 主机名称
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $HostName;

    /**
     * @var string 主板序列号
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $BaseBoardSn;

    /**
     * @var string 绑定账户只有名字
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $AccountUsers;

    /**
     * @var string 身份策略版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $IdentityStrategyVer;

    /**
     * @var string 身份策略新版本
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $IdentityNewStrategyVer;

    /**
     * @var string 最近登录账号部门
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $AccountGroupName;

    /**
     * @var string 登录账号姓名
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $AccountName;

    /**
     * @var integer 账号组id
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $AccountGroupId;

    /**
     * @param integer $Id 设备ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Mid 设备唯一标识符
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Name 终端名（设备名）
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $GroupId 设备所在分组ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $OsType OS平台(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Ip 设备IP地址（出口IP）
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $OnlineStatus 在线状态 2 在线 0，1 离线(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Version 客户端版本号-大整数
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $StrVersion 客户端版本号-点分字符串
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Itime 首次在线时间
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $ConnActiveTime 最后一次在线时间
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $Locked 设备是否加锁 1 锁定 0 2 非锁定(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $LocalIpList 设备本地IP列表, 包括IP
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $HostId 主机ID(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $GroupName 设备所属分组名
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $GroupNamePath 设备所属分组路径
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $CriticalVulListCount 未修复高危漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $ComputerName 设备名 和Name相同，保留参数
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $DomainName 登录域名
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $MacAddr MAC地址
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $VulCount 漏洞数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $RiskCount 病毒风险数(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $VirusVer 病毒库版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $VulVersion 漏洞库版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $SysRepVersion 系统修复引擎版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param array $VulCriticalList 高危补丁列表
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Tags 标签
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $UserName 终端用户名
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $FirewallStatus 防火墙状态(只支持32位)
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $SerialNum SN序列号
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $DeviceStrategyVer 设备管控策略版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $NGNStrategyVer NGN策略版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $IOAUserName 最近登录账号
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $DeviceNewStrategyVer 设备管控新策略
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $NGNNewStrategyVer NGN策略新版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $HostName 主机名称
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $BaseBoardSn 主板序列号
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $AccountUsers 绑定账户只有名字
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $IdentityStrategyVer 身份策略版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $IdentityNewStrategyVer 身份策略新版本
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $AccountGroupName 最近登录账号部门
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $AccountName 登录账号姓名
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $AccountGroupId 账号组id
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
        if (array_key_exists("Id",$param) and $param["Id"] !== null) {
            $this->Id = $param["Id"];
        }

        if (array_key_exists("Mid",$param) and $param["Mid"] !== null) {
            $this->Mid = $param["Mid"];
        }

        if (array_key_exists("Name",$param) and $param["Name"] !== null) {
            $this->Name = $param["Name"];
        }

        if (array_key_exists("GroupId",$param) and $param["GroupId"] !== null) {
            $this->GroupId = $param["GroupId"];
        }

        if (array_key_exists("OsType",$param) and $param["OsType"] !== null) {
            $this->OsType = $param["OsType"];
        }

        if (array_key_exists("Ip",$param) and $param["Ip"] !== null) {
            $this->Ip = $param["Ip"];
        }

        if (array_key_exists("OnlineStatus",$param) and $param["OnlineStatus"] !== null) {
            $this->OnlineStatus = $param["OnlineStatus"];
        }

        if (array_key_exists("Version",$param) and $param["Version"] !== null) {
            $this->Version = $param["Version"];
        }

        if (array_key_exists("StrVersion",$param) and $param["StrVersion"] !== null) {
            $this->StrVersion = $param["StrVersion"];
        }

        if (array_key_exists("Itime",$param) and $param["Itime"] !== null) {
            $this->Itime = $param["Itime"];
        }

        if (array_key_exists("ConnActiveTime",$param) and $param["ConnActiveTime"] !== null) {
            $this->ConnActiveTime = $param["ConnActiveTime"];
        }

        if (array_key_exists("Locked",$param) and $param["Locked"] !== null) {
            $this->Locked = $param["Locked"];
        }

        if (array_key_exists("LocalIpList",$param) and $param["LocalIpList"] !== null) {
            $this->LocalIpList = $param["LocalIpList"];
        }

        if (array_key_exists("HostId",$param) and $param["HostId"] !== null) {
            $this->HostId = $param["HostId"];
        }

        if (array_key_exists("GroupName",$param) and $param["GroupName"] !== null) {
            $this->GroupName = $param["GroupName"];
        }

        if (array_key_exists("GroupNamePath",$param) and $param["GroupNamePath"] !== null) {
            $this->GroupNamePath = $param["GroupNamePath"];
        }

        if (array_key_exists("CriticalVulListCount",$param) and $param["CriticalVulListCount"] !== null) {
            $this->CriticalVulListCount = $param["CriticalVulListCount"];
        }

        if (array_key_exists("ComputerName",$param) and $param["ComputerName"] !== null) {
            $this->ComputerName = $param["ComputerName"];
        }

        if (array_key_exists("DomainName",$param) and $param["DomainName"] !== null) {
            $this->DomainName = $param["DomainName"];
        }

        if (array_key_exists("MacAddr",$param) and $param["MacAddr"] !== null) {
            $this->MacAddr = $param["MacAddr"];
        }

        if (array_key_exists("VulCount",$param) and $param["VulCount"] !== null) {
            $this->VulCount = $param["VulCount"];
        }

        if (array_key_exists("RiskCount",$param) and $param["RiskCount"] !== null) {
            $this->RiskCount = $param["RiskCount"];
        }

        if (array_key_exists("VirusVer",$param) and $param["VirusVer"] !== null) {
            $this->VirusVer = $param["VirusVer"];
        }

        if (array_key_exists("VulVersion",$param) and $param["VulVersion"] !== null) {
            $this->VulVersion = $param["VulVersion"];
        }

        if (array_key_exists("SysRepVersion",$param) and $param["SysRepVersion"] !== null) {
            $this->SysRepVersion = $param["SysRepVersion"];
        }

        if (array_key_exists("VulCriticalList",$param) and $param["VulCriticalList"] !== null) {
            $this->VulCriticalList = $param["VulCriticalList"];
        }

        if (array_key_exists("Tags",$param) and $param["Tags"] !== null) {
            $this->Tags = $param["Tags"];
        }

        if (array_key_exists("UserName",$param) and $param["UserName"] !== null) {
            $this->UserName = $param["UserName"];
        }

        if (array_key_exists("FirewallStatus",$param) and $param["FirewallStatus"] !== null) {
            $this->FirewallStatus = $param["FirewallStatus"];
        }

        if (array_key_exists("SerialNum",$param) and $param["SerialNum"] !== null) {
            $this->SerialNum = $param["SerialNum"];
        }

        if (array_key_exists("DeviceStrategyVer",$param) and $param["DeviceStrategyVer"] !== null) {
            $this->DeviceStrategyVer = $param["DeviceStrategyVer"];
        }

        if (array_key_exists("NGNStrategyVer",$param) and $param["NGNStrategyVer"] !== null) {
            $this->NGNStrategyVer = $param["NGNStrategyVer"];
        }

        if (array_key_exists("IOAUserName",$param) and $param["IOAUserName"] !== null) {
            $this->IOAUserName = $param["IOAUserName"];
        }

        if (array_key_exists("DeviceNewStrategyVer",$param) and $param["DeviceNewStrategyVer"] !== null) {
            $this->DeviceNewStrategyVer = $param["DeviceNewStrategyVer"];
        }

        if (array_key_exists("NGNNewStrategyVer",$param) and $param["NGNNewStrategyVer"] !== null) {
            $this->NGNNewStrategyVer = $param["NGNNewStrategyVer"];
        }

        if (array_key_exists("HostName",$param) and $param["HostName"] !== null) {
            $this->HostName = $param["HostName"];
        }

        if (array_key_exists("BaseBoardSn",$param) and $param["BaseBoardSn"] !== null) {
            $this->BaseBoardSn = $param["BaseBoardSn"];
        }

        if (array_key_exists("AccountUsers",$param) and $param["AccountUsers"] !== null) {
            $this->AccountUsers = $param["AccountUsers"];
        }

        if (array_key_exists("IdentityStrategyVer",$param) and $param["IdentityStrategyVer"] !== null) {
            $this->IdentityStrategyVer = $param["IdentityStrategyVer"];
        }

        if (array_key_exists("IdentityNewStrategyVer",$param) and $param["IdentityNewStrategyVer"] !== null) {
            $this->IdentityNewStrategyVer = $param["IdentityNewStrategyVer"];
        }

        if (array_key_exists("AccountGroupName",$param) and $param["AccountGroupName"] !== null) {
            $this->AccountGroupName = $param["AccountGroupName"];
        }

        if (array_key_exists("AccountName",$param) and $param["AccountName"] !== null) {
            $this->AccountName = $param["AccountName"];
        }

        if (array_key_exists("AccountGroupId",$param) and $param["AccountGroupId"] !== null) {
            $this->AccountGroupId = $param["AccountGroupId"];
        }
    }
}
