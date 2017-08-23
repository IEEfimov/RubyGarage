<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 1:34
 */

usleep(400000);

?>

    <input type="text" id="newLogin" placeholder="Логин" class="input" onkeyup="loginChanged()">
    <br>
    <div class="alert" id = "alert1"></div>
    <input type="password" id="newPass" placeholder="Ваш пароль" class="input" onkeyup="loginChanged()">
    <br>
    <div class="alert" id = "alert2"></div>
    <div class="alert"> 123</div>
    <input type="button" id="up" disabled value="Регистрация" class="button" onclick="signUp()">
    <div id="signUp" onclick="loadLoginScreen()"> Назад </div>

