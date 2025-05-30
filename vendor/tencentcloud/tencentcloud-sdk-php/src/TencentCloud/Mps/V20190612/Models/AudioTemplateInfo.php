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
namespace TencentCloud\Mps\V20190612\Models;
use TencentCloud\Common\AbstractModel;

/**
 * 音频流配置参数
 *
 * @method string getCodec() 获取音频流的编码格式。
当不需要对音频进行转码时，可选值为：
<li>copy。</li>
当外层参数 Container 为 mp3 时，可选值为：
<li>mp3。</li>
当外层参数 Container 为 ogg 或 flac 时，可选值为：
<li>flac。</li>
当外层参数 Container 为 m4a 时，可选值为：
<li>aac；</li>
<li>mp3；</li>
<li>ac3。</li>
当外层参数 Container 为 mp4 或 flv 时，可选值为：
<li>aac：更适合 mp4；</li>
<li>mp3：更适合 flv；</li>
<li>mp2。</li>
当外层参数 Container 为 hls 时，可选值为：
<li>aac；</li>
<li>mp3。</li>
 * @method void setCodec(string $Codec) 设置音频流的编码格式。
当不需要对音频进行转码时，可选值为：
<li>copy。</li>
当外层参数 Container 为 mp3 时，可选值为：
<li>mp3。</li>
当外层参数 Container 为 ogg 或 flac 时，可选值为：
<li>flac。</li>
当外层参数 Container 为 m4a 时，可选值为：
<li>aac；</li>
<li>mp3；</li>
<li>ac3。</li>
当外层参数 Container 为 mp4 或 flv 时，可选值为：
<li>aac：更适合 mp4；</li>
<li>mp3：更适合 flv；</li>
<li>mp2。</li>
当外层参数 Container 为 hls 时，可选值为：
<li>aac；</li>
<li>mp3。</li>
 * @method integer getBitrate() 获取音频流的码率，取值范围：0 和 [26, 256]，单位：kbps。
当取值为 0，表示音频码率和原始音频保持一致。
 * @method void setBitrate(integer $Bitrate) 设置音频流的码率，取值范围：0 和 [26, 256]，单位：kbps。
当取值为 0，表示音频码率和原始音频保持一致。
 * @method integer getSampleRate() 获取音频流的采样率，可选值：
<li>32000</li>
<li>44100</li>
<li>48000</li>
单位：Hz。
 * @method void setSampleRate(integer $SampleRate) 设置音频流的采样率，可选值：
<li>32000</li>
<li>44100</li>
<li>48000</li>
单位：Hz。
 * @method integer getAudioChannel() 获取音频通道方式，可选值：
<li>1：单通道</li>
<li>2：双通道</li>
<li>6：5.1声道</li>
当媒体的封装格式是音频格式时（flac，ogg，mp3，m4a）时，声道数不允许设为5.1声道。
默认值：2。
 * @method void setAudioChannel(integer $AudioChannel) 设置音频通道方式，可选值：
<li>1：单通道</li>
<li>2：双通道</li>
<li>6：5.1声道</li>
当媒体的封装格式是音频格式时（flac，ogg，mp3，m4a）时，声道数不允许设为5.1声道。
默认值：2。
 */
class AudioTemplateInfo extends AbstractModel
{
    /**
     * @var string 音频流的编码格式。
当不需要对音频进行转码时，可选值为：
<li>copy。</li>
当外层参数 Container 为 mp3 时，可选值为：
<li>mp3。</li>
当外层参数 Container 为 ogg 或 flac 时，可选值为：
<li>flac。</li>
当外层参数 Container 为 m4a 时，可选值为：
<li>aac；</li>
<li>mp3；</li>
<li>ac3。</li>
当外层参数 Container 为 mp4 或 flv 时，可选值为：
<li>aac：更适合 mp4；</li>
<li>mp3：更适合 flv；</li>
<li>mp2。</li>
当外层参数 Container 为 hls 时，可选值为：
<li>aac；</li>
<li>mp3。</li>
     */
    public $Codec;

    /**
     * @var integer 音频流的码率，取值范围：0 和 [26, 256]，单位：kbps。
当取值为 0，表示音频码率和原始音频保持一致。
     */
    public $Bitrate;

    /**
     * @var integer 音频流的采样率，可选值：
<li>32000</li>
<li>44100</li>
<li>48000</li>
单位：Hz。
     */
    public $SampleRate;

    /**
     * @var integer 音频通道方式，可选值：
<li>1：单通道</li>
<li>2：双通道</li>
<li>6：5.1声道</li>
当媒体的封装格式是音频格式时（flac，ogg，mp3，m4a）时，声道数不允许设为5.1声道。
默认值：2。
     */
    public $AudioChannel;

    /**
     * @param string $Codec 音频流的编码格式。
当不需要对音频进行转码时，可选值为：
<li>copy。</li>
当外层参数 Container 为 mp3 时，可选值为：
<li>mp3。</li>
当外层参数 Container 为 ogg 或 flac 时，可选值为：
<li>flac。</li>
当外层参数 Container 为 m4a 时，可选值为：
<li>aac；</li>
<li>mp3；</li>
<li>ac3。</li>
当外层参数 Container 为 mp4 或 flv 时，可选值为：
<li>aac：更适合 mp4；</li>
<li>mp3：更适合 flv；</li>
<li>mp2。</li>
当外层参数 Container 为 hls 时，可选值为：
<li>aac；</li>
<li>mp3。</li>
     * @param integer $Bitrate 音频流的码率，取值范围：0 和 [26, 256]，单位：kbps。
当取值为 0，表示音频码率和原始音频保持一致。
     * @param integer $SampleRate 音频流的采样率，可选值：
<li>32000</li>
<li>44100</li>
<li>48000</li>
单位：Hz。
     * @param integer $AudioChannel 音频通道方式，可选值：
<li>1：单通道</li>
<li>2：双通道</li>
<li>6：5.1声道</li>
当媒体的封装格式是音频格式时（flac，ogg，mp3，m4a）时，声道数不允许设为5.1声道。
默认值：2。
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
        if (array_key_exists("Codec",$param) and $param["Codec"] !== null) {
            $this->Codec = $param["Codec"];
        }

        if (array_key_exists("Bitrate",$param) and $param["Bitrate"] !== null) {
            $this->Bitrate = $param["Bitrate"];
        }

        if (array_key_exists("SampleRate",$param) and $param["SampleRate"] !== null) {
            $this->SampleRate = $param["SampleRate"];
        }

        if (array_key_exists("AudioChannel",$param) and $param["AudioChannel"] !== null) {
            $this->AudioChannel = $param["AudioChannel"];
        }
    }
}
