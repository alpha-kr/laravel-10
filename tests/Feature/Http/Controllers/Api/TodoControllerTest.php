<?php

use App\Models\Category;
use App\Models\Todo;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('can list todo', function () {
    get(route('todos.index'))
        ->assertStatus(200);
});

test('can create todo', function () {
    $data = ['title' => fake()->sentence(2)];

    post(route('todos.store'), $data)
        ->assertStatus(201);

    assertDatabaseHas('todos', $data);
});

test('can create todo with categories', function () {

    $categories = Category::factory(2)
        ->create();

    $data = [
        'title' => fake()->sentence(2),
        'categories' =>  $categories->pluck('id')->toArray()
    ];

    $response = post(route('todos.store'), $data);

    $response->assertStatus(201);

    $newTodoId = $response->collect('data.id');

    assertDatabaseHas(
        'todos',
        $response->collect('data')
            ->only('id', 'title')
            ->toArray()
    );

    $categories->each(
        fn ($item) => assertDatabaseHas(
            'category_todos',
            ['category_id' => $item->id, 'todo_id' => $newTodoId]
        )
    );
});

test('can update todo', function () {

    $todo = Todo::factory()->create();

    $data = ['title' => 'hello 2', 'completed' => true];

    put(route('todos.update', $todo), $data)
        ->assertStatus(200);

    assertDatabaseHas('todos', $data);
});



test('can add categories to existing todo', function () {

    $categoryNumber = 2;

    $todo = Todo::factory()->create();

    $categories = Category::factory($categoryNumber)
        ->create();

    $data = ['categories' => $categories->pluck('id')->toArray()];

    put(route('todos.update', $todo), $data)
        ->assertStatus(200);

    expect(
        $todo->categories()
            ->whereIn('categories.id', $data['categories'])
            ->count()
    )->toBe($categoryNumber);
});

test('can delete todo', function () {
    $todo = Todo::factory()->create();

    delete(route('todos.destroy', $todo))
        ->assertNoContent();

    assertDatabaseMissing('todos', $todo->toArray());
});
