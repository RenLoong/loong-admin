<?php

namespace app\expose\build\config;

use app\expose\utils\DataModel;

class Web extends DataModel
{
    protected $data = [
        # 应用名称
        'web_name'          => '星火API',
        # LOGO展示方式
        'logo_use'          => 'svg',
        # 应用浅色LOGO
        'web_logo_light'    => '',
        # 应用深色LOGO
        'web_logo_dark'     => '',
        # ICP备案
        'web_icp'           => '',
        # 公安备案号
        'web_mps'           => '',
        # 公安备案文案
        'web_mps_text'      => '',
        # 网站标题
        'web_title'         => '',
        # 版本名称
        'version_name'      => 'v1.0.0',
        # 版本号
        'version'           => 10000,
        # 版权信息
        'copyright'         => 'copyright © 2020 RenLoong All Rights Reserved',
        # 微信客服链接
        'wechat_url'        => '',
        # 客服二维码
        'wechat_qrcode_url' => '',
        # 页面布局，control: 控制台布局，admin: 后台布局
        'layout'            => 'control',
    ];
    public function __construct(array $data = [])
    {
        $request = request();
        $this->data['layout'] = $request->app;
        $this->data = array_merge($this->data, $data);
    }
    public function useLogin(array $data = [])
    {
        $this->data['login']        = new Login($data);
        return $this;
    }
    public function useVcode(array $data = [])
    {
        $this->data['vcode']        = new Login($data);
        return $this;
    }
    public function useRegister(array $data = [])
    {
        $this->data['register']        = new Login($data);
        return $this;
    }
    public function useQrcodeLogin(array $data = [])
    {
        $this->data['qrcode_login']        = new Login($data);
        return $this;
    }
    public function useApis(array $data = [])
    {
        $this->data['apis']        = new Apis($data);
        return $this;
    }
    public function useToolbar(array $data = [])
    {
        $this->data['toolbar']        = $data;
        return $this;
    }
    public function useUserDropdownMenu(array $data = [])
    {
        $this->data['user_dropdown_menu']        = $data;
        return $this;
    }
}
