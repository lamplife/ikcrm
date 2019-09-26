<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/25
 * Time: 6:48 PM
 */

namespace Firstphp\Ikcrm\Bridge;

use Hyperf\Guzzle\ClientFactory;

class Http
{

    const BASE_URI = 'https://dingtalk.e.ikcrm.com/';

    /**
     * @var attr
     */
    protected $componentToken;

    /**
     * @var attr
     */
    protected $componentAppid;

    /**
     * @var attr
     */
    protected $authorizerToken;

    /**
     * @var attr
     */
    protected $uploadType;

    /**
     * @var object
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var object
     */
    protected $clientFactory;


    public function __construct(array $config = [], ClientFactory $clientFactory)
    {
        $baseUri = isset($config['url']) && $config['url'] ? $config['url'] : static::BASE_URI;
        $token = isset($config['token']) && $config['token'] ? $config['token'] : '';
        $this->baseUrl = $baseUri;
        $this->clientFactory = $clientFactory;
        $options = [
            'base_uri' => $baseUri,
            'timeout' => 2.0,
            'verify' => false,
            'headers' => [
                'Authorization' => "Token token={$token},device=open_api,version_code=9.9.9",
                'Content-Type' => "application/json;charset=utf-8",
            ]
        ];
        $this->client = $clientFactory->create($options);
    }


    public function setComponentToken($componentToken)
    {
        $this->componentToken = $componentToken;
    }


    public function setAuthorizerToken($authorizerToken)
    {
        $this->authorizerToken = $authorizerToken;
    }


    public function setUploadType($type)
    {
        $this->uploadType = $type;
    }


    public function setComponentId()
    {
        $this->componentAppid = config('wxapp.component_id');
    }


    public function __call($name, $arguments)
    {
        if ($this->componentToken) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'component_access_token=' . $this->componentToken;
        }
        if ($this->componentAppid) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'component_appid=' . $this->componentAppid;
        }
        if ($this->authorizerToken) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'access_token=' . $this->authorizerToken;
        }
        if ($this->uploadType) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'type=' . $this->uploadType;
        }

        $response = $this->client->request($name, $arguments[0], $arguments[1])->getBody()->getContents();
        return json_decode($response, true);
    }


}