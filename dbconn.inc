<?php

// DB 접속 정보를 가지고 있는 파일

$db_name="bbs";
$user_name="php";
$user_password="php";

$dbconn=mysql_connect("localhost",$user_name,$user_password);
$status=mysql_select_db($db_name,$dbconn);

?>

 