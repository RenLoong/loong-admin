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
namespace TencentCloud\Tbaas\V20180416\Models;
use TencentCloud\Common\AbstractModel;

/**
 * DescribeFabricTransaction请求参数结构体
 *
 * @method string getClusterId() 获取网络ID，可在区块链网络详情或列表中获取
 * @method void setClusterId(string $ClusterId) 设置网络ID，可在区块链网络详情或列表中获取
 * @method string getChannelId() 获取通道ID，可在通道列表或通道详情获取
 * @method void setChannelId(string $ChannelId) 设置通道ID，可在通道列表或通道详情获取
 * @method string getTxId() 获取交易ID
 * @method void setTxId(string $TxId) 设置交易ID
 */
class DescribeFabricTransactionRequest extends AbstractModel
{
    /**
     * @var string 网络ID，可在区块链网络详情或列表中获取
     */
    public $ClusterId;

    /**
     * @var string 通道ID，可在通道列表或通道详情获取
     */
    public $ChannelId;

    /**
     * @var string 交易ID
     */
    public $TxId;

    /**
     * @param string $ClusterId 网络ID，可在区块链网络详情或列表中获取
     * @param string $ChannelId 通道ID，可在通道列表或通道详情获取
     * @param string $TxId 交易ID
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
        if (array_key_exists("ClusterId",$param) and $param["ClusterId"] !== null) {
            $this->ClusterId = $param["ClusterId"];
        }

        if (array_key_exists("ChannelId",$param) and $param["ChannelId"] !== null) {
            $this->ChannelId = $param["ChannelId"];
        }

        if (array_key_exists("TxId",$param) and $param["TxId"] !== null) {
            $this->TxId = $param["TxId"];
        }
    }
}
