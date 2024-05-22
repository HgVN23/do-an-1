<?php
class Session
{
    public static function innit()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function Set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function Get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    public static function checkLogin()
    {
        self::innit();
        if (self::get("dangnhap")) {
            return true;
        }
        return false;
    }

    public static function destroy()
    {
        session_destroy();
        header("location: dangnhap");
    }

    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }
}
