<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FacbookAdService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook_sdk:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Facebook ads api for campaign service, adset etc';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
