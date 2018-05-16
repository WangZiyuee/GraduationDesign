<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 2:07
 */

$songId = $_POST['songId'];
function getMusicUrl($songId)
{
    $port = 'http://www.istack.wang:3000/music/url';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $port . '?' . 'id=' . $songId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = json_decode(curl_exec($ch), true);
    curl_close($ch);
    $songUrl = $data['data'][0]['url'];
    return $songUrl;
}

$url = getMusicUrl($songId);
echo $url;