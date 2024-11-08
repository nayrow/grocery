<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'grammage' => 'required',
        ]);

        Item::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'grammage' => $request->grammage,
            'user_id' => Auth::user()->id,
        ]);


        return redirect()->route('list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCheckedItems(Request $request)
    {
        $items = Item::where('checked', true)->where('user_id', Auth::user()->id)->get();
        foreach ($items as $item) {
            $storedItem = Item::where('name', $item->name)->where('bought', 'true')->first();
            if ($storedItem) {
                if ($item->grammage === $storedItem->grammage) {
                    $storedItem->update([
                        'quantity' => $storedItem->quantity + $item->quantity,
                    ]);
                    $item->delete();
                } else {
                    if ($item->grammage === 'g' && $storedItem->grammage === 'kg') {
                        $storedItem->update([
                            'quantity' => $storedItem->quantity + $item->quantity / 1000,
                        ]);
                        $item->delete();
                    }
                    if ($item->grammage === 'kg' && $storedItem->grammage === 'g') {
                        $storedItem->update([
                            'quantity' => $storedItem->quantity/1000 + $item->quantity,
                            'grammage' => 'kg',
                        ]);
                        $item->delete();
                    }
                    $item->update([
                        'checked' => 0,
                        'bought' => true,
                    ]);
                }
            } else {
                $item->update([
                    'checked' => 0,
                    'bought' => 'true',
                ]);
            }
        }
        return redirect()->route('list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();
        return redirect()->route('list');
    }
}
