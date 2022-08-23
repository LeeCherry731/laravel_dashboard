<?php

namespace App\Http\Livewire;

use App\Models\Item;

use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    public function render()
    {
        $items = Item::paginate(10);
        return view('livewire.items', ['items' => $items]);
    }
}