<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/12
 * Time: 20:15
 * Keyword:demo
 * Description:
 */

require_once "updateUserInfo.php";
//include "config/linkSql.php";
$userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];
//$userName = 'admin';
//$userPassword = '123456';

//if (isset($userName) && isset($userPassword)) {
//    $sql = "SELECT * FROM user_info WHERE user_name='$userName' AND password='$userPassword'";
//    $result = mysqli_query($link, $sql);
//    if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//        echo 1;
//    } else {
//        echo 502;
//    }
//}

$user = new updateUserInfo($userName, $userPassword);
$userCheck = $user->checkUserInfo();
$result = $user->getRecommendList();
return $result;

//$returnList = array();
//$sql = "SELECT song_id,song_name FROM fashion_list ORDER BY RAND() limit 20";
//$result = mysqli_query($link, $sql);
//while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
//    array_push($returnList, $row);
//}
//
//echo json_encode($returnList);
