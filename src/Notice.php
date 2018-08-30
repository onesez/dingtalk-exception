<?php

namespace Onesez\DingtalkException;

class Notice
{
    /**
     * 发送消息通知
     *
     * @param array $data   消息数据
     * @return array    响应结果
     */
    public static function send($data = [])
    {
        // $data = [
        //     'msgtype'=> 'markdown',
        //     'markdown'=> [
        //         'title' => '异常警告',
        //         'text' => "#### 错误详情  \n > sasasa ",
        //     ],
        //     'at'=> [
        //     'atMobiles'=> ['1825718XXXX'],
        //     'isAtAll'=> true,
        //     ]
        // ];
        $api = new Api();
        $api->setHookurl($data['hook_url']);
        unset($data['hook_url']);
        $api->setParams($data);
        return $api->result();
    }

    /**
     * 异常通知
     *
     * @param string $trace 详细消息
     * @return array 返回结果
     */
    public static function catch($trace)
    {
        $data = [
            'msgtype'=> 'markdown',
            'markdown'=> [
                'title' => '异常警告',
                'text' => "#### 错误详情  \n > {$trace} ",
            ],
            'at'=> [
            'isAtAll'=> true,
            ]
        ];
        $api = new Api();
        $api->setParams($data);
        return $api->result();
    }
}
