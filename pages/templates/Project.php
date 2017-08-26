<?php

/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 24.08.2017
 * Time: 15:29
 */
class Project
{
    public $id;
    public $name;
    public $user_id;

    function __construct($id,$name,$user_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->user_id = $user_id;
    }

    function write(){
        echo "
<div id='flex$this->id' class='project'>
    <div class='title'>
        <div class='titleIco'>
            <i class='material-icons'>date_range</i>
        </div>
        <input type='text' class='titleStr' id='name$this->id' value='$this->name' onkeyup='keyup(this)'>  </input>
        <div class='titleActions'>
            <div class='titleActionsIco'>
                <i class='material-icons' id='editBtn$this->id' onclick='editProject(this)'>mode_edit</i>
            </div>
            <div class='titleActionsIco'>
                <i class='material-icons'  id='deleteBtn$this->id' onclick='deleteProject(this)'>delete</i>
            </div>
        </div>
    </div>

    <div class='addTask'>
            <i class='material-icons addTaskImg'>add</i>
        <div class='addTaskControl'>
            <input type='text' class='addTaskInput' placeholder='Start typing here to create a task'
            id='AddTaskInput$this->id' onkeyup='taskStrOnChange(this)'>
            <input type='button' id='AddTaskBtn$this->id' class='addTaskBtn' value='Add Task'  onclick='addTaskOnClick(this)' >
        </div>
    </div>
    <div id='TasksIn$this->id'>";


        include_once("Task.php");

        $host = 'localhost'; // адрес сервера
        $database = 'RubyGarage'; // имя базы данных
        $user = 'root'; // имя пользователя

        $password = ''; // пароль

        $connect = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($connect));

        $query = "SELECT * FROM `Tasks` WHERE `Project`= '$this->id'";
        $result = mysqli_fetch_all( mysqli_query($connect, $query),MYSQLI_ASSOC);

        $index = 0;

        foreach ($result as $item){
            $tasks[$index] = new Task($item['ID'],$item['Priority'],$item['Status'],$item['Name'],$item['Project']);
            $tasks[$index]->write();
            $index++;
        }
        echo "</div>";

        echo "</div>";
    }

}