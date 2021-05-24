<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteTmpFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:tmp-folder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes the tmp folder content';

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
        Storage::disk('public')->deleteDirectory('tmp');

        $this->info('Tmp folder has been deleted');
    }
}
