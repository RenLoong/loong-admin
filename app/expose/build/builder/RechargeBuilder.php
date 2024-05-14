<?php

namespace app\expose\build\builder;

use app\expose\utils\DataModel;

class RechargeBuilder extends DataModel
{
    protected $data = [];
    public function __construct($props = [])
    {
        $this->data['props'] = array_merge([], $props);
        $this->data['list'] = [];
        $this->data['prompt']=[];
    }
    public function addPayment(mixed $data)
    {
        $this->data['payment']=$data;
        return $this;
    }
    public function addList(mixed $data)
    {
        $this->data['list']=$data;
        return $this;
    }
    public function addQrcodePrompt(ComponentBuilder $builder)
    {
        $this->data['prompt']['qrcode'][] = $builder->builder();
        return $this;
    }
    public function addAgreementPrompt(ComponentBuilder $builder)
    {
        $this->data['prompt']['agreement'][] = $builder->builder();
        return $this;
    }
    public function addFooterPrompt(ComponentBuilder $builder)
    {
        $this->data['prompt']['footer'][] = $builder->builder();
        return $this;
    }
    public function addSwiperPrompt(ComponentBuilder $builder)
    {
        $this->data['prompt']['swiper'][] = $builder->builder();
        return $this;
    }
    public function setCreateOrdersApi(string $api)
    {
        $this->data['create_orders']=$api;
        return $this;
    }
    public function setGetOrdersStateApi(string $api)
    {
        $this->data['get_orders_state']=$api;
        return $this;
    }
    public function builder()
    {
        return $this->data;
    }
}
