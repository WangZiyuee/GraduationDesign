<?php

/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 14:57
 * Keyword: 用户类
 * Description: 登录,注册
 */
class initUserInfo
{
    private $userName;
    private $userPassword;

    public function __construct($userName, $userPassword)
    {
        $this->userName = $userName;
        $this->userPassword = $userPassword;
    }

    protected function linkSql($sql)
    {
        define('DB_HOST', '127.0.0.1');
        define('DB_USER', 'root');
        define('DB_PASSWD', 'root');
        define('DB_NAME', 'player');

        error_reporting(0);

        $link = mysqli_connect(constant('DB_HOST'), constant('DB_USER'), constant('DB_PASSWD')) or die("die" . mysqli_error());
        mysqli_select_db($link, constant('DB_NAME'));
        mysqli_query($link, "set names utf8");
        return mysqli_query($link, $sql);
    }

    public function checkUserInfo()
    {
        if (isset($this->userName) && isset($this->userPassword)) {
            $sql1 = "SELECT user_id FROM user_info WHERE user_name='$this->userName' AND password= '$this->userPassword'";
            $result = $this->linkSql($sql1);
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                return $row['user_id'];
            } else {
                return 501;
            }
        }
    }

    public function addUserInfo()
    {
        if (isset($this->userName) && isset($this->userPassword)) {
            $sql1 = "SELECT user_id FROM user_info WHERE user_name='$this->userName'";
            $result = $this->linkSql($sql1);
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                return 302;
            } else {
                $sql2 = "INSERT INTO user_info (user_name,password) VALUES ('$this->userName','$this->userPassword')";
                $this->linkSql($sql2);
                $sql3 = "SELECT user_id FROM user_info WHERE user_name='$this->userName'";
                $result=$this->linkSql($sql3);
                $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
                return $row['user_id'];
            }
        }
    }


    //还需要记录用户潜在的类型
    //需要加日志

}