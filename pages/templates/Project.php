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
        <span class='titleStr'> $this->name </span>
        <div class='titleActions'>
            <div class='titleActionsIco'>
                <i class='material-icons'>mode_edit</i>
            </div>
            <div class='titleActionsIco'>
                <i class='material-icons'>delete</i>
            </div>
        </div>
    </div>

    <div class='addTask'>
            <i class='material-icons addTaskImg'>add</i>
        <div class='addTaskControl'>
            <input type='text' class='addTaskInput' placeholder='Start typing here to create a task'>
            <input type='button' class='addTaskBtn' value='Add Task'>
        </div>
    </div>";

        include_once("Task.php");

        $tasks = array(
            0 => new Task(0,1,false,"Сделать все красиво",0),
            1 => new Task(0,2,true,"Допилить функционал",0),
            2 => new Task(0,2,false,"Поднять сервак",0)
        );

        foreach ($tasks as $task){
            $task->write();
        }

        echo "</div>";

    }

}