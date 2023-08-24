<?php

namespace App\Livewire;

use App\Models\TodoItem;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class TodoList extends Component
{
    public Collection $todos;
    public string $todoText = '';

    public function mount(): void
    {
       $this->selectTodos();
    }

    public function render(): View|Application|Factory|ContractsApplication
    {
        return view('livewire.todo-list');
    }

    public function addTodo(): void
    {
        $todo = new TodoItem();
        $todo->todo = $this->todoText;
        $todo->completed = false;
        $todo->save();

        $this->todoText = '';
        $this->selectTodos();
    }

    public function toggleTodo($id): void
    {
        $todo = TodoItem::where('id', $id)->first();
        if (!$todo) return;

        $todo->completed = !$todo->completed;
        $todo->save();
        $this->selectTodos();
    }

    public function deleteTodo($id): void
    {
        $todo = TodoItem::where('id', $id)->first();
        if (!$todo) return;
        $todo->delete();
        $this->selectTodos();
    }

    public function selectTodos(): void
    {
        $this->todos = TodoItem::orderBy('created_at', 'DESC')->get();
    }
}
