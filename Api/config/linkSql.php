<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/9
 * Time: 21:26
 */

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWD', 'root');
define('DB_NAME', 'player');


error_reporting(0);
date_default_timezone_set('Asia/Shanghai');

$link = mysqli_connect(constant('DB_HOST'), constant('DB_USER'), constant('DB_PASSWD')) or die("die" . mysqli_error());
$db_selected = mysqli_select_db($link, constant('DB_NAME'));
mysqli_query($link, "set names utf8");