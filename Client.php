<?php
/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Date: 17/10/16
 * Time: 23:52
 * Web Site: http://IgnatenkovNikita.ru
 */

namespace ignatenkovnikita\devinotelecomsms;


use GuzzleHttp\Exception\ClientException;
use yii\base\Component;
use yii\base\Exception;

class Client extends Component
{
    /** @var  string $login */
    public $login;

    /** @var  string $password */
    public $password;

    /** @var  string $from */
    public $from;

    /** @var  string $url */
    public $url = 'https://integrationapi.net/rest/';

    /** @var  boolean $enable */
    public $enable = true;

    /** @var  \GuzzleHttp\Client */
    private $_client;

    /** @var  string $_secretKey */
    private $_secretKey;


    public function init()
    {
        $this->_client = new \GuzzleHttp\Client(['base_uri' => $this->url, 'verify' => false]);
        $data = ['login' => $this->login, 'password' => $this->password];
        $request = $this->_send('user/sessionid', $data);
        $this->_secretKey = json_decode($request->getBody()->getContents());
    }

    private function _send($url, $data, $method = "GET")
    {
        $request = null;

        if ($this->enable)
            $request = $this->_client->request($method, $url, [
                'query' => array_merge($data, ['SessionId' => $this->_secretKey])
            ]);

        return $request;
    }

    public function getBalance()
    {
        $request = $this->_send('user/Balance', []);

        return round(json_decode($request->getBody()->getContents()), 2);

    }

    public function send($phone, $message)
    {
        $data = ['DestinationAddress' => $phone, 'Data' => $message, 'SourceAddress' => $this->from, 'Validity' => 10];

        try {
            $request = $this->_send('sms/send', $data, "POST");
            return json_decode($request->getBody()->getContents());
        } catch (ClientException $e) {
            \Yii::error($e->getMessage(), 'sms');
        }


    }
}