<?php

namespace App\Service;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ReCaptcha
 * @package App\Service
 * https://www.google.com/recaptcha/admin#site/340209213?setup
 * https://developers.google.com/recaptcha/docs/verify
 * https://developers.google.com/recaptcha/docs/invisible
 */
class ReCaptcha
{
    protected $userResponse;
    protected $userIp;

    public function __construct(RequestStack $requestStack)
    {
        $request = $requestStack->getCurrentRequest();
        $this->userResponse = $request->request->get('g-recaptcha-response', null);
        $this->userIp = $request->getClientIp();
    }

    public function check()
    {
        if(empty($this->userResponse)){
            return false;
        }
        $reCaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $parameters = [
            'secret' => '6LefqHAUAAAAAPB-9GoTT-DA39a73PEFIrmavDEP',
            'response'=> $this->userResponse
        ];
        if($this->userIp) {
            $parameters['remoteip'] = $this->userIp;
        }

        $client = new Client();
        try {
            $response = $client->request('POST',$reCaptchaUrl,['query' => $parameters]);
        } catch (\Exception $e) {
            if($e instanceof ClientException) {
                $response = $e->getResponse();
            }
        }

        $reCaptchaResult = json_decode($response->getBody()->getContents(), true);
        return $reCaptchaResult['success'] === true;
    }
}