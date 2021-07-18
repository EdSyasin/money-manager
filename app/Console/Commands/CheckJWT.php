<?php

namespace App\Console\Commands;

use App\Services\Jwt;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckJWT extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jwt:check {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check jwt';

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
        $jwt = new Jwt($this->argument('token'));
        $this->info("id: " . $jwt->payload->id);
        $this->info("name: " . $jwt->payload->name);
        $this->info("signature: " . $jwt->signature);
        $this->info("expired at: " . Carbon::createFromTimestamp($jwt->payload->exp));
        $this->info("verified: " . $jwt->verified ? 'yes' : 'no');

        return 0;
    }
}
