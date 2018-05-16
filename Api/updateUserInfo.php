<?php

/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 19:45
 * Keyword:
 * Description:
 */
class updateUserInfo
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

//    public function getRecommendList()
//    {
//        $returnList = array();
//        $sql = "SELECT song_id,song_name,coverimg_url FROM fashion_list ORDER BY RAND() limit 20";
//        $result = $this->linkSql($sql);
//        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//            array_push($returnList, $row);
//        }
//        return json_encode($returnList);
//        //包含song_id,song_name的数组
//    }
}
