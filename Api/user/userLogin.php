<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/15
 * Time: 14:56
 * Keyword: userLogin
 * Description: .regular
 */

require_once "initUserInfo.php";
//处理POST过来的用户姓名和密码
$userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];

$user = new initUserInfo($userName, $userPassword);
$userId = $user->checkUserInfo();
echo $userId;