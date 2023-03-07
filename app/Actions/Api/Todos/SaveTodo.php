<?php

namespace App\Actions\Api\Todos;

use App\Data\Api\TodoData;
use App\Models\Todo;
use Lorisleiva\Actions\Concerns\AsAction;

class SaveTodo
{
    use AsAction;

    public function handle(TodoData $dto):Todo
    {
        return Todo::query()->updateOrCreate(
            ['id'=>$dto->id],
            $dto->toArray()
        );
    }
}
