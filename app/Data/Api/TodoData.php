<?php

namespace App\Data\Api;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TodoData extends Data
{
    public function __construct(
        public ?string  $id,
        public string | Optional $title,
        public string | Optional $end_date,
        public bool   | Optional $completed = false,
        public array  | Optional $categories,
        //
    ) {
    }
}
