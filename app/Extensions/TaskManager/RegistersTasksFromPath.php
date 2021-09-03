<?php

namespace App\Extensions\TaskManager;


use App\Extensions\TaskManager\Kernel\Engine;
use Symfony\Component\Finder\Finder;

trait RegistersTasksFromPath
{
    /**
     * @param string $path
     * @param null $namespace
     */
    public function loadTasksFrom(string $path, $namespace = null)
    {
        $configPath = realpath($path);

        if(!file_exists($path)){
            return;
        }

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $task_file) {
            /** @var \SplFileInfo $task_file */

            $task = $this->resolveTaskFile($task_file, $namespace);

            Engine::init()->addTask($task);

        }
    }

    /**
     * @param \SplFileInfo $file
     * @param null $file_namespace
     * @return Task
     */
    private function resolveTaskFile(\SplFileInfo $file, $file_namespace = null)
    {
        $file_namespace = $file_namespace ?? config('tasks.namespace');

        $class = $file_namespace . '\\' . $file->getBasename('.php');

        $class = str_replace('/','\\', $class);

        return $class::init();
    }

}