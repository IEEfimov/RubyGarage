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

if (isset($_POST['taskText'])) $task = $_POST['taskText'];
else die("error :(");

if (isset($_POST['projectID'])) $project = $_POST['projectID'];
else die("error :(");


$query = "INSERT INTO `tasks`(`Name`, `Status`, `Priority`, `Project`) VALUES ('$task',0,0,$project)";

if (mysqli_query($connect,$query)){
  $query = "SELECT last_insert_id();";
  $result = mysqli_fetch_row(mysqli_query($connect, $query));
  echo $result[0];
}
else die("FALSE = $query");
