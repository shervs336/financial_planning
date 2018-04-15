<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will reset the admin to admin/password';

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
        $user = User::find(1);

        $user->update([
          'username' => 'admin',
          'password' => bcrypt('password')
        ]);

        echo 'Admin successfully reset to admin/password';
    }
}
