<?php
namespace Onesez\DingtalkException;

class Api
{
    public $params;
    public $hook_url;

    /**
     * 初始化信息
     * @author wending <postmaster@g000.cn>
     */
    public function __construct()
    {
        $this->hook_url = 'https://oapi.dingtalk.com/robot/send?access_token=56a48bae0978208060933c2d5e8bfd36b2a0b91663f6f0d0b74baafe5d5d8ec1';
    }

    /**
     * 设置Hook的URL
     *
     * @param string $name  URL地址
     */
    public function setHookurl($url)
    {
        $this->hook_url = $url;
    }

    /**
     * 设置请求参数
     *
     * @param array $params 请求参数
     */
    public function setParams($params = [])
    {
        $this->params = $params;
    }

    /**
     * HTTP请求
     *
     * @param array $params
     * @return array 响应参数
    */
    public function result()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->hook_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->params));
        $res = curl_exec($ch);
        curl_close($ch);
        $arr = json_decode($res, true);
        return $arr;
    }
}
