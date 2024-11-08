<?php

namespace App\Livewire;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CurrentList extends Component
{
    public string $query = '';
    public array $items = [];

    public array $queryString = ['query' => ['except' => '']];

    public function mount()
    {
        $this->items = $this->searchItems()->toArray();
    }

    public function updatedQuery()
    {
        $this->items = $this->searchItems()->toArray();
    }

    public function searchItems()
    {
        return Item::where('user_id', Auth::user()->id)
            ->where('bought','false')
            ->where('name', 'like', '%' . $this->query . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function checkItem(string $id): void
    {
        $item = Item::find($id);
        $item->update([
            'checked' => !$item->checked,
        ]);
    }

    public function render(): View
    {
        return view('livewire.current-list',[
            'items' => $this->items,
        ]);
    }
}
