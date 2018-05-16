<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 2:10
 */

include 'config/linkSql.php';

$songId = $_POST['songId'];
$userId = $_POST['userId'];

$sql = "SELECT * FROM 'music_list' WHERE song_id IN '$songId'";
$respondData = mysqli_fetch_array(mysqli_query($link, $sql), MYSQLI_ASSOC);
$songName = $respondData['song_name'];
$songTag = $respondData['song_tag'];
$recordTime = date("Y-m-d H:i:s", time());
//确认格式?
$sql = "INSERT INTO user_like (user_id,song_id,song_name,song_tag,record_time) VALUES ('$userId','$songId','$songName','$songTag','$recordTime')";
mysqli_query($link, $sql);
//确认数据库插入成功?