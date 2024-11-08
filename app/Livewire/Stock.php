<?php

namespace App\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stock extends Component
{
    public string $query = '';
    public array $queryString = ['query' => ['except' => '']];
    public function updatedQuery()
    {
        $this->items = $this->searchItems()->toArray();
    }
    public function searchItems()
    {
        return Item::where('user_id', Auth::user()->id)
            ->where('bought', 'true')
            ->where('name', 'like', '%' . $this->query . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.stock',[
            'items' =>$this->searchItems()
        ]);
    }
}
