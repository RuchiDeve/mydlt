<?php

namespace App\Extensions\TaskManager;


use App\Extensions\TaskManager\Console\ProcessTasks;
use App\Extensions\TaskManager\Kernel\Engine;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class TaskServiceProvider extends ServiceProvider
{
    use RegistersTasksFromPath;

    protected $commands = [
        ProcessTasks::class,
    ];


    // boot provider
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/tasks.php', 'tasks');

        $this->loadTasksFrom(app_path('Tasks'));
    }


    public function register()
    {
        $this->registerConsoleCommands();
    }

    protected function registerConsoleCommands(){
        if(property_exists(self::class, 'commands'))
            $this->commands($this->commands);
    }




}