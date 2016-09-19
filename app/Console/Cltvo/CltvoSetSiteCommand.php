<?php

namespace App\Console\Cltvo;

use Illuminate\Console\Command;

// use App\Console\Cltvo\Sets\RoleSet;

class CltvoSetSiteCommand extends Command
{
    /**
     * resiter set classes
     * @var array
     */
    protected $set_classes = [
        'App\Console\Cltvo\Sets\PermissionSet',
        'App\Console\Cltvo\Sets\RoleSet',
        'App\Console\Cltvo\Sets\AssociatePermissionRoleSet',
        'App\Console\Cltvo\Sets\FirstUserSet',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cltvo:set {--s|seed : Seed the database with records } {--r|migrate-refresh : Rollback all database migrations } {--c|clean : seed and migrate-refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preconfiguration of the App';

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
        if ($this->option("migrate-refresh") || $this->option("clean")) {
            $this->call("migrate:refresh");
        }

        foreach ($this->set_classes as $class) {

            $seter = new $class;
            $seter->CltvoSet($this);
            $this->info( $seter->CltvoGetLabel()." set successfully." );
        }

        if ($this->option("seed") || $this->option("clean")) {
            shell_exec("composer dump-autoload");
            $this->call("db:seed");
        }
    }

}
