<?php

namespace App\Console\Commands;

use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class CreateIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:index {index}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new index";

    /**
     * Create a new command instance.
     *
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
        $params = [
            'index' => $this->argument('index'),
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 1
                ]
            ]
        ];

        $response = app(ClientBuilder::class)->indices()->create($params);
        $this->info($response["acknowledged"]);
        return 0;
    }
}
