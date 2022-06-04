<?php
declare (strict_types = 1);

namespace app\controller\divingfish;

use app\BaseController;
use app\facade\MaiDxProber;

class ProberController extends BaseController
{
    public function updateRecordPageParser()
    {
        $param = $this->request->only(['username', 'password', 'file']);
        $this->validate($param, [
            'username' => 'require',
            'password' => 'require',
        ]);
        $file = $this->request->file('file');
        if (!$file) {
            exception('请上传文件');
        }

        $file = $file->getRealPath();
        $website = file_get_contents($file);
        $userMusic = MaiDxProber::page2json($website);
        $cookie = MaiDxProber::login($param['username'], $param['password']);
        if (isset($cookie['cookie'])) {
            $cookie = $cookie['cookie'];
        } else {
            exception('登录账号失败');
        }
        $res = MaiDxProber::uploadRecord($cookie, $userMusic);
        return json_succ($res);
    }
}
