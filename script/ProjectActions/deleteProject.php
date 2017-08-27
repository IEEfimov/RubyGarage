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

$DeletedID = -1;
if (isset($_POST['deletedID'])) $DeletedID = $_POST['deletedID'];
if ($DeletedID == -1) die("Unset id error");

$query = "DELETE FROM `projects` WHERE ID='$DeletedID'";

if (mysqli_query($connect,$query)){
    $query = "DELETE FROM `tasks` WHERE Project='$DeletedID'";

    if (mysqli_query($connect,$query)){
        echo $DeletedID;
    }
}
else die("FALSE");
