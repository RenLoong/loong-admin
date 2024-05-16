<?php
namespace app\expose\utils\wechat\modules;
trait Reply
{
    private function replyText($data,$content)
    {
        $result=[
            'ToUserName' => "<![CDATA[{$data['FromUserName']}]]>",
            'FromUserName' => "<![CDATA[{$data['ToUserName']}]]>",
            'CreateTime' => time(),
            'MsgType' => '<![CDATA[text]]>',
            'Content' => "<![CDATA[{$content}]]>"
        ];
        return xml(arrayToXml($result));
    }
    private function replyImage($data,$media_id)
    {
        $result=[
            'ToUserName' => "<![CDATA[{$data['FromUserName']}]]>",
            'FromUserName' => "<![CDATA[{$data['ToUserName']}]]>",
            'CreateTime' => time(),
            'MsgType' => '<![CDATA[image]]>',
            'Image' => [
                'MediaId' => "<![CDATA[{$media_id}]]>"
            ]
        ];
        return xml(arrayToXml($result));
    }
    private function replyVoice($data,$media_id)
    {
        $result=[
            'ToUserName' => "<![CDATA[{$data['FromUserName']}]]>",
            'FromUserName' => "<![CDATA[{$data['ToUserName']}]]>",
            'CreateTime' => time(),
            'MsgType' => '<![CDATA[voice]]>',
            'Voice' => [
                'MediaId' => "<![CDATA[{$media_id}]]>"
            ]
        ];
        return xml(arrayToXml($result));
    }
    private function replyVideo($data,$media_id,$title='',$description='')
    {
        $result=[
            'ToUserName' => "<![CDATA[{$data['FromUserName']}]]>",
            'FromUserName' => "<![CDATA[{$data['ToUserName']}]]>",
            'CreateTime' => time(),
            'MsgType' => '<![CDATA[video]]>',
            'Video' => [
                'MediaId' => "<![CDATA[{$media_id}]]>",
                'Title' => "<![CDATA[{$title}]]>",
                'Description' => "<![CDATA[{$description}]]>"
            ]
        ];
        return xml(arrayToXml($result));
    }
    private function replyMusic($data,$thumb_media_id,$title='',$description='',$music_url='',$hq_music_url='')
    {
        $result=[
            'ToUserName' => "<![CDATA[{$data['FromUserName']}]]>",
            'FromUserName' => "<![CDATA[{$data['ToUserName']}]]>",
            'CreateTime' => time(),
            'MsgType' => '<![CDATA[music]]>',
            'Music' => [
                'Title' => "<![CDATA[{$title}]]>",
                'Description' => "<![CDATA[{$description}]]>",
                'MusicUrl' => "<![CDATA[{$music_url}]]>",
                'HQMusicUrl' => "<![CDATA[{$hq_music_url}]]>",
                'ThumbMediaId' => "<![CDATA[{$thumb_media_id}]]>"
            ]
        ];
        return xml(arrayToXml($result));
    }
    private function replyNews($data,$articles)
    {
        $result=[
            'ToUserName' => "<![CDATA[{$data['FromUserName']}]]>",
            'FromUserName' => "<![CDATA[{$data['ToUserName']}]]>",
            'CreateTime' => time(),
            'MsgType' => '<![CDATA[news]]>',
            'ArticleCount' => count($articles),
            'Articles' => []
        ];
        foreach ($articles as $article) {
            $result['Articles'][]=[
                'Title' => "<![CDATA[{$article['title']}]]>",
                'Description' => "<![CDATA[{$article['description']}]]>",
                'PicUrl' => "<![CDATA[{$article['picurl']}]]>",
                'Url' => "<![CDATA[{$article['url']}]]>"
            ];
        }
        return xml(arrayToXml($result));
    }
}