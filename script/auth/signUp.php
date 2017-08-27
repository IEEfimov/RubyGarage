<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 4:27
 */

include_once("../DBparams.php");

$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$login = trim($_POST['login']);
$password = md5($_POST['password']);

$query = "SELECT count(*) as total FROM `users` WHERE `Login`= '$login'";
$result=mysqli_query($connect,$query);

$count=mysqli_fetch_assoc($result);


if ($count['total'] > 0) die("isExist");


$query = "INSERT INTO `users` VALUES ('','$name','$surname','$login','$password')";
if (mysqli_query($connect,$query)) echo "TRUE";
else echo "FALSE";
