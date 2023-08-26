<?php

namespace App\Livewire;

use App\Models\Continent;
use App\Models\Country;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Livewire\Component;

class CascadingDropdown extends Component
{
    public Collection $continents;
    public Collection $countries;

    public string $selectedContinent;
    public string $selectedCountry;

    public function mount(): void
    {
        $this->continents = Continent::all();
    }

    public function render(): View|Application|Factory|ContractApplication
    {
        return view('livewire.cascading-dropdown');
    }

    public function changeContinent(): void
    {
        if ($this->selectedContinent !== '-1') {
            $this->countries = Country::where('continent_id', $this->selectedContinent)->get();
        }
    }
}
