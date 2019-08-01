<?php

/**
 *  +----------------------------------------------------------------------
 *  |  [ WE CAN DO IT JUST THINK ]
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2018 http://www.monapay.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://www.apache.org/licenses/LICENSE-2.0 )
 *  +----------------------------------------------------------------------
 *  | 
 *  +----------------------------------------------------------------------
 */

namespace app\common\model;


class User extends BaseModel
{
    /**
     *
     * 
     *
     * @param $uid
     * @return User|bool|null
     * @throws \think\exception\DbException
     */
    public function getUser($uid){
        $user = self::get(['uid' => $uid],true);
        if ($user) {
            return $user;
        }
        return false;
    }

}

