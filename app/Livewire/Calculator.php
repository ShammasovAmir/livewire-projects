<?php

namespace App\Livewire;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Calculator extends Component
{
    public float|string $number1 = 0;
    public float|string $number2 = 0;
    public string $action = "+";
    public float $result = 0;
    public bool $disabled = false;

    public function render(): View|Application|Factory|ContractApplication
    {
        return view('livewire.calculator');
    }

    public function calculate(): void
    {
        $num1 = (float)$this->number1;
        $num2 = (float)$this->number2;
        $divider = $num2 == 0 ? 1 : $num2;

        $this->result = match ($this->action) {
            '-' => $num1 - $num2,
            '+' => $num1 + $num2,
            '*' => $num1 * $num2,
            '/' => $num1 / $divider,
            '%' => $num1 / 100 * $divider
        };
    }

    public function updated($property): void
    {
        $this->disabled = match ($this->number1 == '' || $this->number2 == '') {
            true => true,
            default => false,
        };
    }
}
