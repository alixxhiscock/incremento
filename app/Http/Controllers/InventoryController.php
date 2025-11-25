<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function showInventoryPage()
    {
        $user = auth()->user();
        $inventory = $user->inventory ?? [];

        return view('inventory',[
            'inventory' => $inventory
        ]);
    }
    public function showInventoryData()
    {
        $user = auth()->user();
        $inventory = $user->inventory ?? [];

        return response()->json(['inventory' => $inventory]);
    }
}
