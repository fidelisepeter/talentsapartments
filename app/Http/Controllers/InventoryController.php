<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\PurchasedItem;
use App\Models\InventoryCategory;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('pages.inventories.index');
    }

    public function categories()
    {
        

        return view('pages.inventories.categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->item_input) {
            Inventory::create([
                "category_id" => $request->category_id,
                "item" => $request->item_input,
                "quantity" => $request->quantity,
                "cost" => $request->cost,
                "description" => $request->description,
            ]);
            return redirect('/inventories')->with('success', 'Item added successfully');
        } else {
            $inventory = Inventory::where('item', $request->item_select)->first();
            $inventory->update([
                "category_id" => $request->category_id,
                "quantity" => $inventory->quantity + $request->quantity,
                "cost" => $request->cost,
                "description" => $request->description,
            ]);
            return redirect('/inventories')->with('success', 'Item updated successfully');
        }
    }

    public function store_category(Request $request)
    {
        InventoryCategory::create([
            "title" => $request->title,
            "description" => $request->description,
        ]);
        return redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {

        $item = $inventory;
        return view('pages.inventories.update')->with(compact('item'));
    }

    public function get_items_by_category($id)
    {


        $options = '';
        foreach (\App\Models\Inventory::where('category_id', $id)->get('item')->unique('item') as $data) {

            $options .= "<option value=\"$data->item\">$data->item</option>";
        }


        return $options;
    }

    public function get_items_details_by_name($name)
    {


        // return  json_encode(Inventory::with('purchased')->where('item', $name)->get());
        $inventory = Inventory::with('purchased')->where('item', $name)->get();

        $modifiedInventory = $inventory->map(function ($item) {
            $remainingQuantity = $item->quantity - $item->purchased->sum('quantity');
            return [
                'id' => $item->id,
                'cost' => $item->cost,
                'quantity' => $item->quantity,
                'remaining_quantity' => $remainingQuantity,
            ];
        });

        return json_encode($modifiedInventory);
    }

    public function item_exist(Request $request)
    {

        $itemCheck = Inventory::where('item', $request->new_name)->where('id', '!=', $request->id)->first();
        if ($itemCheck) {
            return json_encode([
                'valid' => false,
                'message' => $request->new_name . ' already exist in ' . $itemCheck->category_name
            ]);
        } else {
            return json_encode([
                'valid' => true,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $inventory->update([
            "item" => $request->item_input,
            "category_id" => $request->category_id,
            "quantity" => $inventory->quantity + $request->quantity,
            "cost" => $request->cost,
            "description" => $request->description,
        ]);
        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function update_category(Request $request, InventoryCategory $category)
    {
        $category->update([
            "title" => $request->title,
            "description" => $request->description,
        ]);
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect('/inventories')->with('success', 'Item was deteted');
    }

    public function destroy_category(InventoryCategory $category)
    {
        $category->delete();
        return redirect('/inventories/categories')->with('success', 'Category was deteted');
    }

    
}
