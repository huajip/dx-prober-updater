<?php
// 应用公共文件
use think\response\Json;

/**
 * 返回正确json
 *
 * @param null $data
 * @param int $code
 * @param string $msg
 * @return Json
 */
function json_succ($data = null, int $code = 1, string $msg = ''): Json
{
    return json([
        'code' => $code,
        'data' => $data,
        'msg' => $msg,
    ])->options([
        'json_encode_param' => JSON_BIGINT_AS_STRING,
    ]);
}

/**
 * 返回错误json
 *
 * @param string|null $msg
 * @param int $code
 * @param null $data
 * @return Json
 */
function json_err(string $msg = null, int $code = 0, $data = null): Json
{
    return json([
        'code' => $code,
        'data' => $data,
        'msg' => $msg,
    ])->options([
        'json_encode_param' => JSON_NUMERIC_CHECK,
    ]);
}

/**
 * 抛出异常
 * @param string $message
 * @param int $code
 * @throws \think\Exception
 */
function exception(string $message = "", int $code = 0)
{
    throw new \think\Exception($message, $code);
}
