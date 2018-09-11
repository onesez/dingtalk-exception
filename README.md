
## 使用方法
1. 首先通过composer安装钉钉异常通知包
>composer require onesez/dingtalk-exception

2. 修改配置文件application/config.php的exception_handle的值为一下
>'exception_handle'       => '\\app\\common\\exception\\Http',

3. 然后配置app\common\exception\Http.php的代码为：
```
<?php
namespace app\common\exception;

use Exception;
use think\Log;
use think\exception\Handle;
use think\exception\HttpException;
use Onesez\DingtalkException\Notice;

class Http extends Handle
{
    public function render(Exception $e)
    {
        // // 参数验证错误
        // if ($e instanceof ValidateException) {
        //     return json($e->getError(), 422);
        // }

        // // 请求异常
        // if ($e instanceof HttpException && request()->isAjax()) {
        //     return response($e->getMessage(), $e->getStatusCode());
        // }

        // Notice::catch($e->getMessage());

        // 配置项目名称
        $app_name = '项目名称';
        $data = [
            // hook地址
            'hook_url' => 'https://oapi.dingtalk.com/robot/send?access_token=56a48bae0978208060933c2d5e8bfd36b2a0b91663f6f0d0b74baafe5d5d8ec1',
            'msgtype' => 'text',
            'text' => [
                'content' => "项目名称：{$app_name}\n错误码：{$e->getCode()}\n错误消息：{$e->getMessage()}\n错误文件：{$e->getFile()}",
            ],
            'at' => [
                'atMobiles' => '17758584001', //通知到你自己的手机号
                'isAtAll'=> true,
            ],
        ];
        // 这个可以使用队列，否则会引起效率低下
        Notice::send($data);

        //TODO::开发者对异常的操作
        //可以在此交由系统处理
        return parent::render($e);
    }
}

```
