<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 18:27
 */

include_once("../DBparams.php");

$login = $_POST['login'];

$query = "SELECT count(*) as total FROM `Users` WHERE `Login`= '$login'";
$result=mysqli_query($connect,$query);
$count=mysqli_fetch_assoc($result);

if ($count['total'] > 0) die("isExist");
else echo "1";