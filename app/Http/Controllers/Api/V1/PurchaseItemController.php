<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseItemRequest;
use App\Http\Requests\UpdatePurchaseItemRequest;
use App\Models\PurchaseItem;

use App\Http\Resources\V1\PurchaseItemResource;

use Illuminate\Support\Facades\Auth;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StorePurchaseItemRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(PurchaseItem $purchaseItem)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseItemRequest $request, PurchaseItem $purchaseItem)
    {
        abort_if($purchaseItem->purchase->user_id !== Auth::id(), 403, 'You do not have permission to modify this purchase');

        // Обновляем позицию
        $purchaseItem->update([
            'quantity' => $request->input('quantity'),
            'total' => round($request->input('quantity') * $purchaseItem->price,2),
        ]);

        // Обновляем общую сумму заказа
        $purchaseItem->purchase->update([
            'total_amount' => round($purchaseItem->purchase->items->sum('total'),2),
        ]);
        return response()->json([
            'message' => 'Purchase item updated successfully',
            'purchase_item' => new PurchaseItemResource($purchaseItem),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseItem $purchaseItem)
    {
        abort_if($purchaseItem->purchase->user_id !== Auth::id(), 403, 'You do not have permission to modify this purchase');
    
        $purchaseItem->delete();

        $purchaseItem->purchase->update([
           'total_amount' => round($purchaseItem->purchase->items->sum('total'),2),
        ]);
    
        return response()->json(['message' => 'Purchase item deleted successfully']);
    }
}
