<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 4:34
 */

$host = 'localhost'; // адрес сервера
$database = 'RubyGarage'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль

// подключаемся к серверу
$connect = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($connect));



function generatePassword($length = 8){
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}
