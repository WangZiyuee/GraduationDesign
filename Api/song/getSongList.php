<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/15
 * Time: 17:49
 * Keyword:
 * Description: 返回歌单
 */

include "../config/linkSql.php";
require_once "initSongList.php";

$userId = $_POST['userId'];
$tags = explode(',', $_POST['tags']);


$songList = new initSongList($userId, $tags);
$resultList = $songList->getRecommendList();

echo $resultList;