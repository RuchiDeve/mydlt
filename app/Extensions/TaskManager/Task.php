<?php

namespace App\Extensions\TaskManager;


use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

abstract class Task
{
    protected $is_sync = false;

    private $connection = 'database';

    private $queue = 'background-tasks';

    protected $trigger;

    protected $title;

    public function getConnection()
    {
        return $this->is_sync ? 'sync' : $this->connection;
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    public function getQueue()
    {
        return $this->queue;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return Str::slug($this->getTitle());
    }

    private function runExecution(...$args)
    {
        if($this->is_sync){
            return $this->execute(...$args);
        } else {
            $task = $this;

            dispatch(function() use ($args, $task){
                $task->execute(...$args);
            })
                ->onConnection($this->getConnection())
                ->onQueue($this->getQueue())
            ;
        }
    }


    /**
     * @param array $args
     */
    abstract public function execute(...$args);

    public function boot()
    {
        if(is_null($this->title)) $this->title = class_basename(get_called_class());

        Event::listen('*', function ($eventName, array $data) {

            if($this->trigger){
                // gets all triggers as array
                $triggers = is_string($this->trigger) ? explode('|', $this->trigger) : $this->trigger;

                foreach ($triggers as $trigger){
                    if ($eventName == $trigger){
                        return $this->runExecution(...$data);
                    }elseif(fnmatch($trigger, $eventName)) {
                        return $this->runExecution(...$data);
                    }
                }

            }
        });

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

    public static function publishTask(self $task, ...$payload)
    {
        $task->runExecution(...$payload);
    }

}
