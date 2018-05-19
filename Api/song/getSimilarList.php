<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/17
 * Time: 18:14
 * Keyword: Similar User
 * Description:
 */

include "../config/linkSql.php";
include "cosieSimilarity.php";

$userId = $_POST["userId"];


//$userId = 10001;

$fashion = 0;
$rock = 0;
$ballad = 0;
$elect = 0;
$classical = 0;
$matel = 0;
$jazz = 0;
$userTags = array();
$sql = "SELECT tag FROM user_like WHERE user_id=$userId GROUP BY song_id";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    switch ($row[0]) {
        case 10001:
            $fashion++;
            break;
        case 10002;
            $rock++;
            break;
        case 10003:
            $ballad++;
            break;
        case 10004:
            $elect++;
            break;
        case 10005:
            $classical++;
            break;
        case 10006:
            $matel++;
            break;
        case 10007:
            $jazz++;
            break;
        default:
            echo "default";
    }
}
$userTags["fashion"] = $fashion;
$userTags["rock"] = $rock;
$userTags["ballad"] = $ballad;
$userTags["elect"] = $elect;
$userTags["classical"] = $classical;
$userTags["matel"] = $matel;
$userTags["jazz"] = $jazz;

//echo "userTags" . "</br>";
//var_dump($userTags);
//echo array_sum($userTags);
//用户标签数组


$sql = "SELECT * FROM `user_info` WHERE user_id NOT IN (10000,$userId)";
$result = mysqli_query($link, $sql);
$rowM = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    array_push($rowM, $row);
}
//用户数量
$tags = array();
$userSimilarity = array();
//比较后的用户相似度
for ($i = 0; $i < count($rowM); $i++) {

    $id = $rowM[$i]["user_id"];
    //用户id
    $fashion = 0;
    $rock = 0;
    $ballad = 0;
    $elect = 0;
    $classical = 0;
    $matel = 0;
    $jazz = 0;
    $sql = "SELECT tag FROM user_like WHERE user_id=$id GROUP BY song_id";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
//        var_dump($row);
        switch ($row[0]) {
            case 10001:
                $fashion++;
                break;
            case 10002;
                $rock++;
                break;
            case 10003:
                $ballad++;
                break;
            case 10004:
                $elect++;
                break;
            case 10005:
                $classical++;
                break;
            case 10006:
                $matel++;
                break;
            case 10007:
                $jazz++;
                break;
            default:
                echo "default";
            //对于空tag需要进行判断
        }
    }
    $tags[$i]["fashion"] = $fashion;
    $tags[$i]["rock"] = $rock;
    $tags[$i]["ballad"] = $ballad;
    $tags[$i]["elect"] = $elect;
    $tags[$i]["classical"] = $classical;
    $tags[$i]["matel"] = $matel;
    $tags[$i]["jazz"] = $jazz;
//    echo "tags" . "</br>";
//    var_dump($tags);
//    echo array_sum($tags[$i]);
    //对比用户的tags数组
    $userSimilarity[$id] = dotp($tags[$i], $userTags) / sqrt(dotp($userTags, $userTags) * dotp($tags[$i], $tags[$i]));
    asort($userSimilarity);
    //降序排列
//    echo "END".end($userSimilarity);
//    echo "ID".key($userSimilarity);
    $simiUserId = key($userSimilarity);

}
//$similarity = dotp($tags[0], $userTags) / sqrt(dotp($userTags, $userTags) * dotp($tags[0], $tags[0]));
//var_dump($userSimilarity);
echo $simiUserId;