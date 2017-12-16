<?php

namespace APP\Models\Traits;

trait UserSocialiteHelper
{
    public static function getByDriver($driver, $id)
    {
        $functionMap = [
            'github' => 'getByGithubId',
            'wechat' => 'getByWechatId'
        ];
        $function = $functionMap[$driver];
        if (!$function) {
            return null;
        }

        return self::$function($id);
    }

    /**
     * 通过 Github id 查找用户
     *
     * @param $id
     * @return mixed
     */
    public static function getByGithubId($id)
    {
        return static::where('github_id', $id)->first();
    }

    /**
     * 通过 wechat openid 查找用户
     *
     * @param $id
     * @return mixed
     */
    public static function getByWechatId($id)
    {
        return static::where('wechat_openid', $id)->first();
    }
}