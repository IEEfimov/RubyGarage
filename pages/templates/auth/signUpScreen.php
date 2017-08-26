<?php
/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 21.08.2017
 * Time: 1:34
 */

usleep(400000);

echo "<div id=\"string\">Тогда давайте познакомимся! </div>

<div id=\"loginScreen\">
    <input type=\"text\" id=\"firstName\" name='name' placeholder=\"Имя\" class=\"input\" onkeyup='nameChanged()'>
    <br>
    <div class=\"alert\" id = \"alert1\"></div>
    <input type=\"text\" id=\"surname\" placeholder=\"Фамилия\" class=\"input\" onkeyup='nameChanged()'>
    <br>
    <div class=\"alert\" id = \"alert2\"></div>
    <input type=\"button\" id='signUpNext' value=\"Далее\" class=\"button\" onclick='signInNext()' disabled>
    <div id=\"signUp\" onclick=\"loadLoginScreen()\"> Назад </div>
</div>";

