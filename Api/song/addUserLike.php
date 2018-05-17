<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/17
 * Time: 14:31
 * Keyword:
 * Description:
 */

include "../config/linkSql.php";

$userId = $_POST["userId"];
$songId = $_POST["songId"];
$tag = $_POST["tag"];
$tab = date('Y-m-d', time());

if ($userId && $songId) {
    $sql = "INSERT INTO user_like (song_id,user_id,tag,tab) VALUES ($songId,$userId,$tag,'$tab')";
    $result = mysqli_query($link, $sql);
    echo json_encode($result);
}


