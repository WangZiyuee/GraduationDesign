<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/6
 * Time: 20:05
 */


$port = 'http://www.istack.wang:3000/top/playlist/highquality';
$cat = '华语';
//获取"$cat"标签的热门歌单,$limit返回歌单数量
function getHotPlayLists($port, $limit, $cat)
{
    $param = array('limit' => $limit, 'cat' => $cat);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $port . '?' . http_build_query($param));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = json_decode(curl_exec($ch), true);
    curl_close($ch);
    $playlist = array();
    for ($i = 0; $i < (int)$limit; $i++) {
        $playlist[$i]['playlistId'] = $data['playlists'][$i]['id'];
        $playlist[$i]['playlistName'] = $data['playlists'][$i]['name'];
        $playlist[$i]['coverImgUrl'] = $data['playlists'][$i]['coverImgUrl'];
        $playlist[$i]['playlistTags'] = $data['playlists'][$i]['tags'];
        $playlist[$i]['oneTag'] = $data['playlists'][$i]['tag'];
    }
    return $playlist;
    //包含歌单ID,封面,标签.
}

//
//$playlist = getHotPlayLists($port, 1, $cat);
//for ($i = 0; $i < count($playlist); $i++) {
//    $thePlaylistId = $playlist[$i]['playlistId'];
//    echo $thePlaylistId;
//    echo '<br>';
//}




