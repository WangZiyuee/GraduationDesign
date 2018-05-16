<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 1:56
 */


include '../config/linkSql.php';
include 'getPlaylistDetail.php';

//$neMusicListId = $_POST['listId'];
//查询歌曲类型索引表
//$neMusicListId = 2220553537; //流行歌单 10001
//$neMusicListId = 2220587049; //摇滚歌单 10002
//$neMusicListId = 2220554770; // 民谣歌单 10003
//$neMusicListId = 2220593085;//电子歌单 10004
//$neMusicListId = 2228705286;//古典 10005
//$neMusicListId = 2211348040;//金属 10006
//$neMusicListId = 2204003018;//爵士 10007
//$listName = 'classical_list';
$listId = 2220593085;
$songTag = 10004;
$tag = '电子';

$recordTime = date('H-m-d H:i:s', time());

$playlistDetail = array();
$playlistDetail = getPlaylistDetail($neMusicListId);

var_dump($playlistDetail);

for ($i = 0; $i < count($playlistDetail); $i++) {
    $songId = $playlistDetail[$i]['song_id'];
    $songName = $playlistDetail[$i]['song_name'];
    $coverImgUrl = $playlistDetail[$i]['song_albumUrl'];
    $sql1 = "INSERT INTO electronic_list (song_id,list_id,song_tag,tag,song_name,coverimg_url) VALUES ('$songId','$listId','$songTag','$tag','$songName','$coverImgUrl')";
    mysqli_query($link, $sql1);
    $sql2 = "INSERT INTO music_list (song_id,song_name,song_tag,tag,coverimg_url,record_time) VALUES ('$songId','$songName','$songTag','$tag','$coverImgUrl','$recordTime')";
    mysqli_query($link, $sql2);
    echo "check" . "<br/>";
}