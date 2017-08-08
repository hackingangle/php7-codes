<?php
/**
 * Created by PhpStorm.
 * User: wanggang
 * Date: 2017/8/8
 * Time: 下午2:31
 */
class Logger {
    /**
     * log
     * @param $msg 消息
     * @param bool $bolMarkRed 标红色，默认不标记红色
     */
    public static function log($msg, $bolMarkRed = false)
    {
        if (is_array($msg)) {
            if ($bolMarkRed) {
                echo "<span color='red'>";
                echo var_export($msg, true). "\n<br/>";
                echo "</span>";
            } else {
                echo "<span color='red'>";
                echo var_export($msg, true). "\n<br/>";
                echo "</span>";
            }
        } else {
            echo $msg. "\n<br/>";
        }
    }
}