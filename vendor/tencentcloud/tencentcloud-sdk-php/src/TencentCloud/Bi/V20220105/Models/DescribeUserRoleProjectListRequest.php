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
namespace TencentCloud\Bi\V20220105\Models;
use TencentCloud\Common\AbstractModel;

/**
 * DescribeUserRoleProjectList请求参数结构体
 *
 * @method integer getPageNo() 获取页码
 * @method void setPageNo(integer $PageNo) 设置页码
 * @method integer getPageSize() 获取页数
 * @method void setPageSize(integer $PageSize) 设置页数
 * @method integer getProjectId() 获取项目ID
 * @method void setProjectId(integer $ProjectId) 设置项目ID
 * @method boolean getIsOnlyBindAppUser() 获取是否只获取绑定企微应用的
 * @method void setIsOnlyBindAppUser(boolean $IsOnlyBindAppUser) 设置是否只获取绑定企微应用的
 */
class DescribeUserRoleProjectListRequest extends AbstractModel
{
    /**
     * @var integer 页码
     */
    public $PageNo;

    /**
     * @var integer 页数
     */
    public $PageSize;

    /**
     * @var integer 项目ID
     */
    public $ProjectId;

    /**
     * @var boolean 是否只获取绑定企微应用的
     */
    public $IsOnlyBindAppUser;

    /**
     * @param integer $PageNo 页码
     * @param integer $PageSize 页数
     * @param integer $ProjectId 项目ID
     * @param boolean $IsOnlyBindAppUser 是否只获取绑定企微应用的
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
        if (array_key_exists("PageNo",$param) and $param["PageNo"] !== null) {
            $this->PageNo = $param["PageNo"];
        }

        if (array_key_exists("PageSize",$param) and $param["PageSize"] !== null) {
            $this->PageSize = $param["PageSize"];
        }

        if (array_key_exists("ProjectId",$param) and $param["ProjectId"] !== null) {
            $this->ProjectId = $param["ProjectId"];
        }

        if (array_key_exists("IsOnlyBindAppUser",$param) and $param["IsOnlyBindAppUser"] !== null) {
            $this->IsOnlyBindAppUser = $param["IsOnlyBindAppUser"];
        }
    }
}
