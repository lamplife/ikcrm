<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/25
 * Time: 6:47 PM
 */

namespace Firstphp\Ikcrm;


interface IkcrmInterface
{

    /**
     * 用户模块 - 用户登录
     *
     * @param string $login
     * @param string $password
     * @param string $corp_id
     * @param string $device
     * @param string $version_code
     * @return mixed
     */
    public function login(string $login, string $password, string $corp_id = '', string $device = 'open_api', string $version_code = '9.9.9', string $corp_id = '');


    /**
     * 用户模块 - 用户列表
     *
     * @param array $params
     * @return mixed
     */
    public function userList(array $params = []);


    /**
     * 用户信息
     *
     * @return mixed
     */
    public function userInfo();


    /**
     * 用户模块 - 简单用户列表
     *
     * @param array $params
     * @return mixed
     */
    public function userSimpleList(array $params = []);


    /**
     * 用户模块 - 部门列表
     *
     * @param int $exceptId
     * @return mixed
     */
    public function departmentList(int $except_id = 0);


    /**
     * 用户模块 - 用户详情
     *
     * @param int $id
     * @return mixed
     */
    public function userDetail(int $id = 0);


    /**
     * 客户模块 - 客户列表
     *
     * @param array $params
     * @return mixed
     */
    public function customers(array $params = []);


    /**
     * 客户模块 - 客户详情
     *
     * @param int $id
     * @return mixed
     */
    public function customersDetail(int $id = 0);


    /**
     * 客户模块 - 客户联系人
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function customersContacts(int $id = 0, array $params = []);


}