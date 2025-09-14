<?php

use Illuminate\Support\Facades\Facade;

return [

    'aliases' => Facade::defaultAliases()->merge([
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
    ])->toArray(),

];
