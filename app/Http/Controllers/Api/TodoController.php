<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\Todos\SaveTodo;
use App\Data\Api\TodoData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TodoResource::collection(
            Todo::query()->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {

        return new TodoResource(
            SaveTodo::run(
                dto: TodoData::from($request->safe([
                    'title',
                ]))
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return  new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        return new TodoResource(
            SaveTodo::run(
                dto: TodoData::from([
                    'id' => $todo->id,
                    ...$request->safe([
                        'title',
                        'completed'
                    ])
                ])
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->noContent();
    }
}
