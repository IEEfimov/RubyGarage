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

    function __construct($id,$priority,$status,$name,$project_id)
    {
        $this->id = $id;
        $this->priority = $priority;
        $this->status = $status;
        $this->name = $name;
        $this->project_id = $project_id;
    }

    function write(){
        $checked = "";
        if ($this->status == true) $checked = "checked";
        echo "
    <div class='task'>
        <div class='taskCheckDiv'>
            <input type='checkbox' class='taskCheck' $checked>
        </div>

        <div class='taskStr'> $this->name</div>
        <div class='taskActions'>
            <div class='taskActionsManage taskCheck'>
                <i class='material-icons taskManageIco taskManageAction'>arrow_drop_up</i>
                <i class='material-icons taskManageAction'>arrow_drop_down</i>
            </div>

            <i class='material-icons taskCheck taskManageAction'>mode_edit</i>
            <i class='material-icons taskCheck taskManageAction'>delete</i>

        </div>
    </div>";
    }

}