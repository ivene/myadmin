<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->initAdminData();
        $this->info('Admin Init Data Complete!!');
    }

    public function initAdminData(){
        $this->call('db:seed',['--class'=>\DatabaseSeeder::class]);
    }
}
