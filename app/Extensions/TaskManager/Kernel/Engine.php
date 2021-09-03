<?php

namespace App\Extensions\TaskManager\Kernel;


use App\Extensions\TaskManager\Task;

class Engine
{
    private $resolved_tasks = [];


    public function addTask(Task $task)
    {
        $task->boot();

        $this->resolved_tasks[] = $task;
    }

    /**
     * @return self
     */
    public static function init()
    {
        $class = get_called_class();

        $object = app($class);

        if(!app()->has($class)){
            app()->instance($class, $object);
        }

        return $object;
    }

}