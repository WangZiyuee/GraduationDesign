<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/17
 * Time: 16:28
 * Keyword:
 * Description:
 */

include "../config/linkSql.php";

$userId = $_POST["userId"];

$sql = "SELECT song_id FROM user_like WHERE user_id=$userId GROUP BY song_id;";
$result = mysqli_query($link, $sql);
$rowM = array();
$userLikeList=array();
while ($row = mysqli_fetch_array($result, 1)) {
    array_push($rowM, $row);
}
for ($i = 0; $i < count($rowM); $i++) {
    $songId = (int)($rowM[$i]['song_id']);
    $sql = "SELECT * FROM music_list WHERE song_id=$songId";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result, 1)) {
        array_push($userLikeList, $row);
    }
}
echo json_encode($userLikeList);