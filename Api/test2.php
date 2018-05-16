<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/14
 * Time: 14:32
 * Keyword: demo
 * Description: 登录后获取歌单
 */

include "config/linkSql.php";
$userId = $_POST['userId'];
$returnList = array();
$sql = "SELECT song_id,song_name,coverimg_url FROM fashion_list ORDER BY RAND() limit 20";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($returnList, $row);
}
echo json_encode($returnList);