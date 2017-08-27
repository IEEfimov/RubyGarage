<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 25.08.2017
 * Time: 19:43
 */

include_once("../../script/DBparams.php");

if (isset($_COOKIE['current_login'])){
    $query = "SELECT * FROM `Users` WHERE `Login`= '".$_COOKIE['current_login']."'";
}
$user = mysqli_fetch_assoc( mysqli_query($connect, $query));

if ($user['Password'] != $_COOKIE["Password"]){
    setcookie("Password","");
    $message = "Wrong password!";
    echo $message;
    die("wrong pass");
}

$taskID = -1;
if (isset($_POST['taskID'])) $taskID = $_POST['taskID'];
if ($taskID == -1) die("Unset id error");

if (isset($_POST['newValue'])) $newValue = $_POST['newValue'];


$query = "UPDATE `Tasks` SET `Status`=$newValue WHERE ID=$taskID";

if (mysqli_query($connect,$query)){
    echo "TRUE";
}
else die("FALSE");
