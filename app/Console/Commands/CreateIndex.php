<?php

namespace App\Console\Commands;

use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:index {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new index given model name";

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
        $model = "App\\".$this->argument('model');
        $params = [
            'index' => Str::lower(Str::plural($this->argument('model'))),
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 1
                ],
                'mappings' => $model::getMappings()
            ]
        ];

        $response = app(ClientBuilder::class)->indices()->create($params);
        $this->info($response["acknowledged"]);
        return 0;
    }
}
