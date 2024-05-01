<?php

namespace App\ConstantValues;

class StepConstantValues {
    const READING_TYPE = 'reading';
    const VIDEO_TYPE = 'video';
    const QUIZ_TYPE = 'quiz';

    const STEP_ENUM_ARRAY = [
        self::READING_TYPE,
        self::VIDEO_TYPE,
        self::QUIZ_TYPE,
    ];
}
