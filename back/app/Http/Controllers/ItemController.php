<?php

namespace App\Http\Controllers; 

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::get();

        return view ('home', compact('items'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return view('showItem',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);

        return view('editItem', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item=request()->except('_token', '_method');

        Item::where('id', '=', $id)->update($item);

        return redirect()->route('home')
            ->with('success', 'Item updated successfully');
    }



        public function destroy($id)
        {
            Item::destroy($id);

            return redirect()->route('home');
        }




    public function create()
    {
        $item = new Item();
        return view('createItem', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate(Item::$rules);

    $item = new Item();
    $item->itemName = $request->itemName;
    $item->category = $request->category;
    $item->description = $request->description;
    $item->image = $request->image;
    $item->stockQuantity = $request->stockQuantity;
    $item->price = $request->price;
    $item->save();

    // Attach the item to the user with a quantity of 1
    $user = Auth::user();
    $user->items()->attach($item->id, ['quantity' => 1]);

    return redirect()->route('home')
        ->with('success', 'Item created successfully');
}


public function buy($id)
{
    // Get the authenticated user
    $user = Auth::user();

    // Get the item to be bought
    $item = Item::findOrFail($id);

    // Check if the user already has the item in their inventory
    $existingPivot = $user->items()->where('item_id', $item->id)->first();

    if ($existingPivot) {
        // Update the quantity in the pivot table
        $existingPivot->pivot->quantity++;
        $existingPivot->pivot->save();
    } else {
        // Attach the item to the user with a quantity of 1
        $user->items()->attach($item->id, ['quantity' => 1]);
    }

    // Decrement the stock quantity of the item
    $item->stockQuantity--;

    // Save the changes
    $item->save();

    return redirect()->back()->with('success', 'Item bought successfully');
}

}

