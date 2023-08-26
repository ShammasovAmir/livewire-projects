<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;

    public string $search = '';

    protected array $queryString = ['search'];

    public function render(): View|Application|Factory|ContractApplication
    {
        $query = Product::query();
        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%");
        }

        return view('livewire.product-search', [
            'products' => $query->paginate(20)
        ]);
    }

    public function updated($property): void
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }
}
