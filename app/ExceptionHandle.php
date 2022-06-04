<?php

namespace app;

use GuzzleHttp\Exception\GuzzleException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\db\exception\PDOException;
use think\Exception;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * 将异常呈现到HTTP响应中
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 参数验证错误
        if ($e instanceof ValidateException)
            return json_err($e->getMessage(), -abs($e->getCode()));

        // 数据库异常
        if ($e instanceof PDOException) {
            $data = $e->getData();
            if (isset($data['PDO Error Info'])) {
                $code = $data['PDO Error Info']['SQLSTATE'];
                switch ($code) {
                    case 22003:
                        return json_err('数据重复', -abs($code));
                    default:
                        return json_err($e->getMessage(), -abs($code));
                }
            }
        }

        // 系统异常
        if (($e instanceof Exception || $e instanceof GuzzleException))
            return json_err($e->getMessage(), -abs($e->getCode()));

        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}
