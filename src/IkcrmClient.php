<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/25
 * Time: 6:47 PM
 */

namespace Firstphp\Ikcrm;

use Firstphp\Ikcrm\Bridge\Http;
use Psr\Container\ContainerInterface;
use Hyperf\Guzzle\ClientFactory;

class IkcrmClient implements IkcrmInterface
{


    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var object
     */
    protected $http;

    /**
     * @var object
     */
    protected $clientFactory;

    /**
     * @var ContainerInterface
     */
    protected $container;


    public function __construct(array $config = [], ContainerInterface $container, ClientFactory $clientFactory)
    {
        $config = $config ? $config : config('ikcrm');
        if ($config) {
            $this->url = $config['url'];
            $this->username = $config['ikcrmUsername'];
            $this->password = $config['ikcrmPassword'];
        }
        $this->clientFactory = $clientFactory;
        $config['token'] = '';
        $res = $this->login();
        if (isset($res['code']) && $res['code'] == 0) {
            $config['token'] = isset($res['data']['user_token']) ? $res['data']['user_token'] : '';
        }
        $this->http = $container->make(Http::class, compact('config'));
    }


    /**
     * @return mixed
     */
    public function login()
    {
        $arguments = [
            'device' => 'open_api',
            'version_code' => '9.9.9',
            'login' => $this->username,
            'password' => $this->password
        ];
        $options = [
            'base_uri' => $this->url,
            'timeout' => 2.0,
            'verify' => false
        ];
        $client = $this->clientFactory->create($options);
        return json_decode($client->request('post', 'api/v2/auth/login', ['json' => $arguments])->getBody()->getContents(), true);
    }


    /**
     * 用户信息
     */
    public function userInfo()
    {
        return $this->http->get('api/v2/user/info', [
            'query' => []
        ]);
    }


    /**
     * @param array $params
     */
    public function userList(array $params = [])
    {
        $data = [];
        if (is_array($params) && !empty($params)) {
            foreach ($params as $key => $val) {
                switch ($key) {
                    case 'page':
                        $data['page'] = $val;
                        break;
                    case 'per_page':
                        $data['per_page'] = $val;
                        break;
                    case 'name':
                        $data['name'] = $val;
                        break;
                    case 'department_id':
                        $data['department_id'] = $val;
                        break;
                    case 'user_id':
                        $data['user_id'] = $val;
                        break;
                    case 'sort':
                        $data['sort'] = $val;
                        break;
                    case 'order':
                        $data['order'] = $val;
                        break;
                    case 'except_user_id':
                        $data['except_user_id'] = $val;
                        break;
                    case 'dingtalk_userid':
                        $data['dingtalk_userid'] = $val;
                        break;
                    default:
                        break;
                }
            }
        }

        return $this->http->get('api/v2/user/list', [
            'query' => $data
        ]);
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function userSimpleList(array $params = [])
    {
        $data = [];
        if (is_array($params) && !empty($params)) {
            foreach ($params as $key => $val) {
                switch ($key) {
                    case 'page':
                        $data['page'] = $val;
                        break;
                    case 'per_page':
                        $data['per_page'] = $val;
                        break;
                    case 'by_permission':
                        $data['by_permission'] = $val;
                        break;
                    case 'except_user_id':
                        $data['except_user_id'] = $val;
                        break;
                    case 'query':
                        $data['query'] = $val;
                        break;
                    case 'department_id':
                        $data['department_id'] = $val;
                        break;
                    case 'user_id':
                        $data['user_id'] = $val;
                        break;
                    default:
                        break;
                }
            }
        }

        return $this->http->get('api/v2/simple_list', [
            'query' => $data
        ]);
    }


    /**
     * @param int $except_id
     * @return mixed
     */
    public function departmentList(int $except_id = 0)
    {
        return $this->http->get('api/v2/user/department_list', [
            'query' => [
                'except_id' => $except_id
            ]
        ]);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function userDetail(int $id = 0)
    {
        return $this->http->get('api/v2/user/' . $id, [
            'query' => []
        ]);
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function customers(array $params = [])
    {
        $data = [];
        if (is_array($params) && !empty($params)) {
            foreach ($params as $key => $val) {
                switch ($key) {
                    case 'page':
                        $data['page'] = $val;
                        break;
                    case 'per_page':
                        $data['per_page'] = $val;
                        break;
                    case 'query':
                        $data['query'] = $val;
                        break;
                    case 'department_id':
                        $data['department_id'] = $val;
                        break;
                    case 'sort':
                        $data['sort'] = $val;
                        break;
                    case 'order':
                        $data['order'] = $val;
                        break;
                    case 'tab_type':
                        $data['tab_type'] = $val;
                        break;
                    case 'user_id':
                        $data['user_id'] = $val;
                        break;
                    case 'status':
                        $data['status'] = $val;
                        break;
                    case 'category':
                        $data['category'] = $val;
                        break;
                    case 'real_revisit_at':
                        $data['real_revisit_at'] = $val;
                        break;
                    case 'product_id':
                        $data['product_id'] = $val;
                        break;
                    case 'source':
                        $data['source'] = $val;
                        break;
                    default:
                        break;
                }
            }
        }

        return $this->http->get('api/v2/customers', [
            'query' => $data
        ]);
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function customersDetail(int $id = 0)
    {
        return $this->http->get('api/v2/customers/' . $id, [
            'query' => []
        ]);
    }


    /**
     * @param int $id
     * @param array $params
     */
    public function customersContacts(int $id = 0, array $params = [])
    {
        $data = [];
        if (is_array($params) && !empty($params)) {
            foreach ($params as $key => $val) {
                switch ($key) {
                    case 'page':
                        $data['page'] = $val;
                        break;
                    case 'per_page':
                        $data['per_page'] = $val;
                        break;
                    default:
                        break;
                }
            }
        }

        return $this->http->get("api/v2/customers/{$id}/contacts", [
            'query' => $data
        ]);
    }


}