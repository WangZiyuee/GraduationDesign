<?php

/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/15
 * Time: 17:35
 * Keyword:
 * Description: 返回歌单
 */
class initSongList
{
    private $userId;
    private $tags;

    public function __construct($userId, $tags)
    {
        $this->userId = $userId;
        $this->tags = $tags;
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

//    public function getHotList()
//    {
//
//    }
//    public function getUserlikeList(){
//
//    }
//public function getRandList(){
//
//}

    public function getRecommendList()
    {
        $returnList = array();
        $recommendNum = 20;
        //推荐歌单歌曲数量
        if ($this->tags[0] === "") {
            $sql2 = "SELECT song_id,song_name,tag,coverimg_url FROM music_list ORDER BY RAND() limit 20";
            $result = $this->linkSql($sql2);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                array_push($returnList, $row);
            }
        } else {
            $arrLenght = count($this->tags);
            $limitNum = round($recommendNum / $arrLenght);
            //四舍五入计算要推荐类型歌曲的数量
            for ($i = 0; $i < $arrLenght; $i++) {
                $sql1 = "SELECT song_id,song_name,tag,coverimg_url FROM music_list WHERE song_tag = " . $this->tags[$i] . " ORDER BY RAND() limit $limitNum";
                $result = $this->linkSql($sql1);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    array_push($returnList, $row);
                }
            }

        }
        return json_encode($returnList);
        //包含song_id,song_name的数组
    }
}