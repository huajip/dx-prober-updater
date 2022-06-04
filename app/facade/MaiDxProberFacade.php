<?php

namespace app\facade;

use Curl\Curl;
use Exception;

class MaiDxProberFacade
{
    public function login($username, $password)
    {
        $prober_account = array(
            'username' => $username,
            'password' => $password,
        );
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('User-Agent', 'fufubot-prober-tools');
        $curl->post('https://www.diving-fish.com/api/maimaidxprober/login', json_encode($prober_account));
        $curl->close();

        if ($curl->error) {
            Exception('登录失败', $curl->error_code);
        } else {
            $res = json_decode($curl->response, true);
            $responseInfo = $curl->response_headers;
            foreach ($responseInfo as $loop) {
                if (strpos($loop, "set-cookie") !== false) {
                    $cookie = trim(substr($loop, 22));
                    $cookie = explode(';', $cookie)[0];
                }
            }
            $res['cookie'] = $cookie;

            return $res;
        }
    }

    public function uploadRecord($cookie, $userMusic)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('User-Agent', 'fufubot-prober-tools');
        $curl->setCookie('jwt_token', $cookie);
        $userMusic = json_encode($userMusic);
        //$curl->delete('https://www.diving-fish.com/api/maimaidxprober/player/delete_records');
        $curl->post('https://www.diving-fish.com/api/maimaidxprober/player/update_records', $userMusic);
        $curl->close();

        //var_dump($curl->request_headers);
        //var_dump($curl->response_headers);
        if ($curl->error) {
            Exception('更新数据失败', $curl->error_code);
        } else {
            $res = json_decode($curl->response, true);
            return $res;
        }
    }

    public function page2json($website)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'text/plain');
        $curl->setHeader('User-Agent', 'fufubot-prober-tools');
        $curl->post('http://www.diving-fish.com:8089/page',$website);
        $curl->close();

        if ($curl->error) {
            Exception('导入页面信息出错，请确认您导入的是【记录】-【乐曲成绩】-【歌曲类别】', $curl->error_code);
        } else {
            $res = json_decode($curl->response, true);
            return $res;
        }
    }

    public function userProfile($cookie)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('User-Agent', 'fufubot-prober-tools');
        $curl->setCookie('jwt_token', $cookie);
        $curl->get('https://www.diving-fish.com/api/maimaidxprober/player/profile');
        $curl->close();
        if ($curl->error) {
            Exception('获取用户资料失败', $curl->error_code);
        } else {
            $res = json_decode($curl->response, true);
            return $res;
        }
    }

    public function playerQueryB40($username)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('User-Agent', 'fufubot-prober-tools');
        $curl->post('https://www.diving-fish.com/api/maimaidxprober/query/player', array('username' => $username), true);
        $curl->close();
        if ($curl->error) {
            Exception('获取b40信息失败', $curl->error_code);
        } else {
            $res = json_decode($curl->response, true);
            return $res;
        }
    }
    public function playerQueryB50($username)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('User-Agent', 'fufubot-prober-tools');
        $curl->post('https://www.diving-fish.com/api/maimaidxprober/query/player', array('username' => $username, 'b50' => 'True'), true);
        $curl->close();
        if ($curl->error) {
            Exception('获取b50信息失败', $curl->error_code);
        } else {
            $res = json_decode($curl->response, true);
            return $res;
        }
    }
}
