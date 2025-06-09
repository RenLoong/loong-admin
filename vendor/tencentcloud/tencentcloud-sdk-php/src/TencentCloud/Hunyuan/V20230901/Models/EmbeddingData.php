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
namespace TencentCloud\Hunyuan\V20230901\Models;
use TencentCloud\Common\AbstractModel;

/**
 * Embedding 信息。
 *
 * @method array getEmbedding() 获取Embedding 信息，目前为 1024 维浮点数。
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setEmbedding(array $Embedding) 设置Embedding 信息，目前为 1024 维浮点数。
注意：此字段可能返回 null，表示取不到有效值。
 * @method integer getIndex() 获取下标，目前不支持批量，因此固定为 0。
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setIndex(integer $Index) 设置下标，目前不支持批量，因此固定为 0。
注意：此字段可能返回 null，表示取不到有效值。
 * @method string getObject() 获取目前固定为 "embedding"。
注意：此字段可能返回 null，表示取不到有效值。
 * @method void setObject(string $Object) 设置目前固定为 "embedding"。
注意：此字段可能返回 null，表示取不到有效值。
 */
class EmbeddingData extends AbstractModel
{
    /**
     * @var array Embedding 信息，目前为 1024 维浮点数。
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Embedding;

    /**
     * @var integer 下标，目前不支持批量，因此固定为 0。
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Index;

    /**
     * @var string 目前固定为 "embedding"。
注意：此字段可能返回 null，表示取不到有效值。
     */
    public $Object;

    /**
     * @param array $Embedding Embedding 信息，目前为 1024 维浮点数。
注意：此字段可能返回 null，表示取不到有效值。
     * @param integer $Index 下标，目前不支持批量，因此固定为 0。
注意：此字段可能返回 null，表示取不到有效值。
     * @param string $Object 目前固定为 "embedding"。
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
        if (array_key_exists("Embedding",$param) and $param["Embedding"] !== null) {
            $this->Embedding = $param["Embedding"];
        }

        if (array_key_exists("Index",$param) and $param["Index"] !== null) {
            $this->Index = $param["Index"];
        }

        if (array_key_exists("Object",$param) and $param["Object"] !== null) {
            $this->Object = $param["Object"];
        }
    }
}
