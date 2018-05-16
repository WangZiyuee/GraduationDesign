<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/10
 * Time: 16:15
 * Demo: Get music_list by depend on song_tag
 */

include 'config/linkSql.php';
$songTag = 10003;
//$sql = "SELECT song_id FROM music_list WHERE song_tag = '$songTag'";
$sql = "SELECT song_id,song_name FROM music_list WHERE song_tag = '$songTag' ORDER BY RAND() limit 30";
$result = mysqli_query($link, $sql);
$rowM = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//    echo $row['song_id'] . "<br/>";
    array_push($rowM, $row);
}
$recommendList = array();
for ($j = 0; $j < 20; $j++) {
    array_push($recommendList, $rowM[array_rand($rowM)]);
}
var_dump($recommendList);

