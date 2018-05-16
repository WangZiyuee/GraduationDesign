<?php

/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/13
 * Time: 17:22
 * Keyword:
 * Description:
 */
class signintest
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
            $sql1 = "SELECT user_id FROM user_info WHERE user_name='$this->userName'";
            $result = $this->linkSql($sql1);
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                return 502;
            } else {
                $sql2 = "INSERT INTO user_info (user_name,password) VALUES ('$this->userName','$this->userPassword')";
                $this->linkSql($sql2);
                return 101;
            }
        }
    }

    public function getRecommendList()
    {
        $returnList = array();
        $sql = "SELECT song_id,song_name FROM fashion_list ORDER BY RAND() limit 20";
        $result = $this->linkSql($sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            array_push($returnList, $row);
        }

        return json_encode($returnList);
        //包含song_id,song_name的数组

    }

}