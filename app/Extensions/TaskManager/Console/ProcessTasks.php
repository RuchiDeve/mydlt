<?php

namespace App\Extensions\TaskManager\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProcessTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taskmaster:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        $this->description = 'Queue and auto-run tasks';

        parent::__construct();
    }

    public function handle()
    {
        $this->alert('running tasks...');

        $this->call('queue:retry', ['id' => 'all']);

        $this->call('queue:work', [
            'connection' => 'database',
            '--queue' => 'background-tasks',
            '--stop-when-empty' => true,
            '--tries' => 3
        ]);

    }

}