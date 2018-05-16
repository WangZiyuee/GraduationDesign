<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 19:06
 * Demo: Get detail (song_id,song_name,coverimg_url) by array(song_id)
 */

include 'config/linkSql.php';

$songTag = 10003;
//$sql = "SELECT song_id FROM music_list WHERE song_tag = '$songTag'";
$sql = "SELECT song_id FROM music_list WHERE song_tag = '$songTag' ORDER BY RAND() limit 30";
$result = mysqli_query($link, $sql);
$rowM = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//    echo $row['song_id'] . "<br/>";
    array_push($rowM, $row['song_id']);
}
$recommendList = array();
for ($j = 0; $j < 20; $j++) {
    array_push($recommendList, $rowM[array_rand($rowM)]);
}
//var_dump($recommendList);
$rowM2 = array();
for ($i = 0; $i < count($recommendList); $i++) {
    $sql = "SELECT * FROM music_list WHERE song_id = '$recommendList[$i]'";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//    echo $row['song_id'] . "<br/>";
        array_push($rowM2, $row);
    }
}
//var_dump($rowM2);
echo json_encode($rowM2);