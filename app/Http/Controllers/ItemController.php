<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;


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
        ]);

        Item::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
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
     * Update the specified resource in storage.
     */
    public function updateCheckedItems(): RedirectResponse
    {
        $items = Item::where('checked', true)->where('user_id', Auth::user()->id)->get();
        foreach ($items as $item) {
            $storedItem = Item::where('name', $item->name)->where('bought', 'true')->first();
            if ($storedItem) {
                    $storedItem->update([
                        'quantity' => $storedItem->quantity + $item->quantity,
                    ]);
                    $item->delete();
            } else {
                $item->update([
                    'checked' => 0,
                    'bought' => 'true',
                ]);
            }
        }
        return redirect()->route('stock')->with('success','Items bought successfully');
    }

    function updateQuantity(Request $request, Item $item): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required',
        ]);

        $parser = new StdMathParser();

        try {
            $AST = $parser->parse($request->quantity);
            $evaluator = new Evaluator();
            $quantity = $AST->accept($evaluator);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['quantity' => 'Invalid quantity expression.']);
        }

        $item->update([
            'quantity' => $quantity,
        ]);


        return redirect()->route('stock');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();
        return redirect()->back();
    }
}
