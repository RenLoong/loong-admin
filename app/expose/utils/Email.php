<?php

namespace app\expose\utils;


class Email
{
    public $toemail;
    protected $template;
    protected $data;
    public function setTemplate($template)
    {
        $this->template = new $template;
        return $this;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function send()
    {
        $content = $this->template->builder($this->toemail, $this->data);
        p($content);
        return true;
    }
}
