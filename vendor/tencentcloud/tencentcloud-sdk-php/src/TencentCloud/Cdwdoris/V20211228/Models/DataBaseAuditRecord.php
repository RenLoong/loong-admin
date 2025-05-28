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
namespace TencentCloud\Cdwdoris\V20211228\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 数据库审计
 *
 * @method string getOsUser() 获取查询用户
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setOsUser(string $OsUser) 设置查询用户
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getInitialQueryId() 获取查询ID
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInitialQueryId(string $InitialQueryId) 设置查询ID
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getSql() 获取SQL语句
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setSql(string $Sql) 设置SQL语句
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getQueryStartTime() 获取开始时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setQueryStartTime(string $QueryStartTime) 设置开始时间
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getDurationMs() 获取执行耗时
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDurationMs(integer $DurationMs) 设置执行耗时
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getReadRows() 获取读取行数
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setReadRows(integer $ReadRows) 设置读取行数
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getResultRows() 获取读取字节数
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setResultRows(integer $ResultRows) 设置读取字节数
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getResultBytes() 获取结果字节数
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setResultBytes(integer $ResultBytes) 设置结果字节数
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getMemoryUsage() 获取内存
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setMemoryUsage(integer $MemoryUsage) 设置内存
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getInitialAddress() 获取初始查询IP
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setInitialAddress(string $InitialAddress) 设置初始查询IP
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getDbName() 获取数据库
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setDbName(string $DbName) 设置数据库
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getSqlType() 获取sql类型
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setSqlType(string $SqlType) 设置sql类型
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getCatalog() 获取catalog名称
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setCatalog(string $Catalog) 设置catalog名称
注意：此字段可能返回 null，表示取不到有效值。
 */
class DataBaseAuditRecord extends AbstractModel
{
    /**
     * @var string 查询用户
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $OsUser;

    /**
     * @var string 查询ID
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InitialQueryId;

    /**
     * @var string SQL语句
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Sql;

    /**
     * @var string 开始时间
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $QueryStartTime;

    /**
     * @var integer 执行耗时
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DurationMs;

    /**
     * @var integer 读取行数
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $ReadRows;

    /**
     * @var integer 读取字节数
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $ResultRows;

    /**
     * @var integer 结果字节数
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $ResultBytes;

    /**
     * @var integer 内存
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $MemoryUsage;

    /**
     * @var string 初始查询IP
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $InitialAddress;

    /**
     * @var string 数据库
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $DbName;

    /**
     * @var string sql类型
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $SqlType;

    /**
     * @var string catalog名称
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Catalog;

    /**
     * @param string $OsUser 查询用户
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $InitialQueryId 查询ID
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Sql SQL语句
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $QueryStartTime 开始时间
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $DurationMs 执行耗时
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $ReadRows 读取行数
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $ResultRows 读取字节数
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $ResultBytes 结果字节数
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $MemoryUsage 内存
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $InitialAddress 初始查询IP
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $DbName 数据库
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $SqlType sql类型
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Catalog catalog名称
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
        if (array_key_exists("OsUser",$param) and $param["OsUser"] !== null) {
            $this->OsUser = $param["OsUser"];
        }

        if (array_key_exists("InitialQueryId",$param) and $param["InitialQueryId"] !== null) {
            $this->InitialQueryId = $param["InitialQueryId"];
        }

        if (array_key_exists("Sql",$param) and $param["Sql"] !== null) {
            $this->Sql = $param["Sql"];
        }

        if (array_key_exists("QueryStartTime",$param) and $param["QueryStartTime"] !== null) {
            $this->QueryStartTime = $param["QueryStartTime"];
        }

        if (array_key_exists("DurationMs",$param) and $param["DurationMs"] !== null) {
            $this->DurationMs = $param["DurationMs"];
        }

        if (array_key_exists("ReadRows",$param) and $param["ReadRows"] !== null) {
            $this->ReadRows = $param["ReadRows"];
        }

        if (array_key_exists("ResultRows",$param) and $param["ResultRows"] !== null) {
            $this->ResultRows = $param["ResultRows"];
        }

        if (array_key_exists("ResultBytes",$param) and $param["ResultBytes"] !== null) {
            $this->ResultBytes = $param["ResultBytes"];
        }

        if (array_key_exists("MemoryUsage",$param) and $param["MemoryUsage"] !== null) {
            $this->MemoryUsage = $param["MemoryUsage"];
        }

        if (array_key_exists("InitialAddress",$param) and $param["InitialAddress"] !== null) {
            $this->InitialAddress = $param["InitialAddress"];
        }

        if (array_key_exists("DbName",$param) and $param["DbName"] !== null) {
            $this->DbName = $param["DbName"];
        }

        if (array_key_exists("SqlType",$param) and $param["SqlType"] !== null) {
            $this->SqlType = $param["SqlType"];
        }

        if (array_key_exists("Catalog",$param) and $param["Catalog"] !== null) {
            $this->Catalog = $param["Catalog"];
        }
    }
}
