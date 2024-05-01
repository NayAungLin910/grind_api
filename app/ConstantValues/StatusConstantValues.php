<?php

namespace App\ConstantValues;

class StatusConstantValues
{
    const STATUS_COMPLETED = 'completed';
    const STATUS_UNCOMPLETE = 'uncomplete';

    const STATUS_ENUM_ARRAY = [
        self::STATUS_COMPLETED,
        self::STATUS_UNCOMPLETE,
    ];

    const STATUS_ENUM_DEFAULT_VALUE = self::STATUS_UNCOMPLETE;
}
