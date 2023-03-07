<?php

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
    $response = get(route('todos.index'));

    $response->assertStatus(200);
});

test('can create todo', function () {
    $data = ['title' => fake()->sentence(2)];

    $response = post(route('todos.store'), $data);

    $response->assertStatus(201);

    assertDatabaseHas('todos', $data);
});

test('can update todo', function () {

    $todo = Todo::factory()->create();

    $data = ['title' => 'hello 2', 'completed' => true];

    $response = put(route('todos.update', $todo), $data);

    assertDatabaseHas('todos', $data);

    $response->assertStatus(200);
});

test('can delete todo', function () {
    $todo = Todo::factory()->create();

    $response = delete(route('todos.destroy', $todo));

    $response->assertNoContent();

    assertDatabaseMissing('todos', $todo->toArray());
});
