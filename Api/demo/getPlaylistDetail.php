<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/9
 * Time: 21:40
 */

//通过歌单id的返回歌单中包含的歌曲及其'歌曲id','歌名','封面'
function getPlaylistDetail($playlistId)
{
    $port = 'http://www.istack.wang:3000/playlist/detail';
    $param = array('id' => $playlistId);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $port . '?' . http_build_query($param));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = json_decode(curl_exec($ch), true);
    curl_close($ch);
    $playlistSongs = array();
    for ($i = 0; $i < count($data['result']['tracks']); $i++) {
        $playlistSongs[$i]['song_id'] = $data['result']['tracks'][$i]['id'];
        $playlistSongs[$i]['song_name'] = $data['result']['tracks'][$i]['name'];
        $playlistSongs[$i]['song_albumUrl'] = $data['result']['tracks'][$i]['album']['picUrl'];
    }
    return $playlistSongs;
    //返回'歌曲id','歌名','封面'
}