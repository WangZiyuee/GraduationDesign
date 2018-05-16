<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/13
 * Time: 16:58
 * Keyword: demo
 * Description:
 */

require_once "initUserInfo.php";

$userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];

$user = new initUserInfo($userName, $userPassword);

$result=$user->addUserInfo();
echo $result;
