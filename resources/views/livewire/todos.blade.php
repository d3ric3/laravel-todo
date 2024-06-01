<?php

use function Livewire\Volt\{state, with};
use App\Models\Todo;

state(['task']);

with([
    'todos' => fn() => auth()->user()->todos
]);

$delete = function (Todo $todo) {
    $todo->delete();//fn (Todo $todo)=> $todo->delete();
};

$add = function () {
    auth()->user()->todos()->create([
        'task' => $this->task
    ]);

    // \App\Models\Todo::create([
    //     'user_id' => auth()->id(),
    //     'task' => $this->task
    // ]);

    $this->task = '';
};

// $delete = fn(Todo $todo) => $todo->delete();


?>

<div>
    <form wire:submit='add'>
        <input type='text' wire:model='task'>
        <button type='submit'>Add</button>
    </form>

    <div>
        @foreach($todos as $todo)
            <div>
                {{ $todo->task }}
                <button wire:click='delete({{ $todo->id }})'>X</button>
            </div>
        @endforeach
    </div>
</div>
