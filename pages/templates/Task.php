<?php

/**
 * Created by PhpStorm.
 * User: IEEfimov
 * Date: 24.08.2017
 * Time: 15:29
 */
class Task
{
    public $id;
    public $isComplete;
    public $status;
    public $name;
    public $project_id;

    function __construct($id,$status,$name,$project_id)
    {
        $this->id = $id;
        $this->status = $status;
        $this->name = $name;
        $this->project_id = $project_id;
    }

    function write(){
        $checked = "";
        if ($this->status == true) $checked = "checked";
        echo "
    <div class='task' id='task$this->project_id"."_$this->id'>
        <div class='taskCheckDiv'>
            <input type='checkbox' id='checkBox$this->id' onclick='setStatus($this->id,this)' class='taskCheck' $checked>
        </div>
        <div class='taskStrBox'>
        <input type='text' class='taskStr' id='taskStr$this->id' value='$this->name' readonly> </input>
        </div>
        <div class='taskActions'>
            <div class='taskActionsManage taskCheck'>
                <i class='material-icons taskManageIco taskManageAction' id='btnUP$this->id' onclick='priorityUP($this->project_id,this)'>arrow_drop_up</i>
                <i class='material-icons taskManageAction'  id='btnDOWN$this->id' onclick='priorityDOWN($this->project_id,this)'>arrow_drop_down</i>
            </div>

            <i class='material-icons taskCheck taskManageAction' onclick='editTask($this->id)'>mode_edit</i>
            <i class='material-icons taskCheck taskManageAction' onclick='deleteTask($this->project_id ,$this->id)'>delete</i>

        </div>
    </div>";
    }

}