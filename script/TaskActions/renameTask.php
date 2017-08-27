<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 25.08.2017
 * Time: 19:43
 */

include_once("../../script/DBparams.php");

if (isset($_COOKIE['current_login'])){
    $query = "SELECT * FROM `users` WHERE `Login`= '".$_COOKIE['current_login']."'";
}
$user = mysqli_fetch_assoc( mysqli_query($connect, $query));

if ($user['Password'] != $_COOKIE["Password"]){
    setcookie("Password","");
    $message = "Wrong password!";
    echo $message;
    die("wrong pass");
}

$RenamedID = -1;
if (isset($_POST['renamedID'])) $RenamedID = $_POST['renamedID'];
if ($RenamedID == -1) die("Unset id error");

$RenamedName = "";
if (isset($_POST['renamedName'])) $RenamedName = $_POST['renamedName'];

$query = "UPDATE `tasks` SET `Name`='$RenamedName' WHERE ID='$RenamedID'";

if (mysqli_query($connect,$query)){
  echo $RenamedID;
}
else die("FALSE");
