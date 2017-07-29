<?php

namespace LaravelEnso\Core\app\DataTable;

use LaravelEnso\Core\app\Enums\IsActiveEnum;
use LaravelEnso\DataTable\app\Classes\TableStructure;

class OwnersTableStructure extends TableStructure
{
    public function __construct()
    {
        $this->data = [
            'crtNo'         => __('#'),
            'actionButtons' => __('Actions'),
            'headerAlign'   => 'center',
            'bodyAlign'     => 'center',
            'tableName' => __("Registered Entities"),
            'notSearchable' => [1],
            'enumMappings'  => [
                'is_active' => IsActiveEnum::class,
            ],
            'columns' => [
                0 => [
                    'label' => __('Name'),
                    'data'  => 'name',
                    'name'  => 'name',
                ],
                1 => [
                    'label' => __('Description'),
                    'data'  => 'description',
                    'name'  => 'description',
                ],
                2 => [
                    'label' => __('Active'),
                    'data'  => 'is_active',
                    'name'  => 'is_active',
                ],
            ],
        ];
    }
}
