<?php

namespace App\Actions\Api\Todos;

use App\Data\Api\TodoData;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class SaveTodo
{
    use AsAction;

    public function handle(TodoData $dto): Todo
    {
        DB::beginTransaction();

        $todo = Todo::query()->updateOrCreate(
            ['id' => $dto->id],
            $dto->only('title', 'completed')
                ->toArray()
        );

        if (is_array($dto->categories) && !empty($dto->categories)) {
            $todo->categories()
                ->sync($dto->categories);

            $todo->load('categories');
        }

        DB::commit();

        return $todo;
    }
}
