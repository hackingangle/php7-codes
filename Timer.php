<?php
/**
 * Created by PhpStorm.
 * User: wanggang
 * Date: 2017/8/8
 * Time: 下午2:23
 */

class Timer {
    /**
     * 组
     * @var array
     */
    protected static $arrTimerGroups;

    /**
     * 开始
     * @param string $strGroupName 组
     */
    public static function start($strGroupName = 'default')
    {
        self::$arrTimerGroups[$strGroupName]['start'] = microtime(true);
    }

    /**
     * 停止
     * @param string $strGroupName 组
     * @return mixed
     */
    public static function stop($strGroupName = 'default')
    {
        $floatExecuteTime = microtime(true) - self::$arrTimerGroups[$strGroupName]['start'];
        unset(self::$arrTimerGroups[$strGroupName]);
        return $floatExecuteTime;
    }
}