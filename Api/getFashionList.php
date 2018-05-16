<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/9
 * Time: 21:34
 */

include 'config/linkSql.php';
include 'getPlaylistDetail.php';

$playlistDetail = array();
$playlistDetail = getPlaylistDetail(2205772978);

var_dump($playlistDetail);
for ($i = 0; $i < count($playlistDetail); $i++) {
    $songId = $playlistDetail[$i]['song_id'];
    $listId = 1;
    $songTag = 10001;
    $tag = '华语';
    $songName = $playlistDetail[$i]['song_name'];
    $coverImgUrl = $playlistDetail[$i]['song_albumUrl'];
    $sql = "INSERT INTO fashion_list (song_id,list_id,song_tag,tag,song_name,coverimg_url) VALUES ('$songId','$listId','$songTag','$tag','$songName','$coverImgUrl')";
    mysqli_query($link, $sql);
    echo "check" . "<br/>";
}
