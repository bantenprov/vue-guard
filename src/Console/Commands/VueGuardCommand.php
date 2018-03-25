<?php namespace Bantenprov\VueGuard\Console\Commands;

use Illuminate\Console\Command;

/**
 * The VueGuardCommand class.
 *
 * @package Bantenprov\VueGuard
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueGuardCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:vue-guard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\VueGuard package';

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
        $this->info('Welcome to command for Bantenprov\VueGuard package');
    }
}
