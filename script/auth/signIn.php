<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 4:27
 */

include_once("../DBparams.php");


$login = trim($_POST['login']);
$password = md5($_POST['password']);

$query = "SELECT * FROM `Users` WHERE `Login`= '".$login."'";
$user = mysqli_fetch_assoc( mysqli_query($connect, $query));
if ($user['Password'] == $password){
    $message = "YES";
    echo $message;
}
else echo "NO";