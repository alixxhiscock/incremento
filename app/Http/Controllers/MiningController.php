<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiningController extends Controller
{
    public function mineItem(Request $request, String $item){
        $user = $request->user();

        // Map public slugs to internal inventory keys and friendly names
        $map = [
            'coal' => ['key' => 'coal_ore', 'name' => 'Coal Ore'],
            'tin'  => ['key' => 'tin_ore',  'name' => 'Tin Ore'],
        ];

        // Accept either a short slug (e.g. "tin") or the internal key (e.g. "tin_ore")
        if (array_key_exists($item, $map)) {
            $itemKey = $map[$item]['key'];
            $itemName = $map[$item]['name'];
        } elseif (in_array($item, array_column($map, 'key'), true)) {
            // If the provided value is already an internal key, find the friendly name
            $found = null;
            foreach ($map as $slug => $info) {
                if ($info['key'] === $item) {
                    $found = $info;
                    break;
                }
            }
            if ($found) {
                $itemKey = $found['key'];
                $itemName = $found['name'];
            } else {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Invalid item selected.'], 422);
                }
                return back()->withErrors(['item' => 'Invalid item selected.']);
            }
        } else {
            if ($request->ajax()) {
                return response()->json(['error' => 'Invalid item selected.'], 422);
            }
            return back()->withErrors(['item' => 'Invalid item selected.']);
        }

        $inventory = $user->inventory ?? [];
        $index = null;
        foreach($inventory as $invItem => $slot){
            if(($slot['item'] ?? null) === $itemKey) {
                $index = $invItem;
                break;
            }
        }
        if ($index !== null) {
            // Increment item quantity, max 10000
            $inventory[$index]['quantity'] = min($inventory[$index]['quantity'] + 1, 10000);
        } else {
            // Add new item slot if available
            if (count($inventory) < 10) {
                $inventory[] = ['item' => $itemKey, 'quantity' => 1];
            } else {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Inventory full!'], 422);
                }
                return back()->withErrors(['inventory' => 'Inventory full!']);
            }
        }

        // Save updated inventory
        $user->inventory = $inventory;
        $user->save();

        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'message' => "One {$itemName} added to your inventory!"], 200);
        }

        return back()->with('status', "One {$itemName} added to your inventory!");
    }

}
