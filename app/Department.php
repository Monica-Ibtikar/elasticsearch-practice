<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";

    public static function getMappings()
    {
        return [
            'properties' => [
                'developer' => [
                    'type' => 'nested'
                ]
            ]
        ];
    }
}
