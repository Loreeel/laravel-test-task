<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;

use App\Http\Controllers\Controller;

use App\Models\Purchase;
use App\Models\Product;

use App\Http\Resources\V1\PurchaseResource;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        return PurchaseResource::collection(
            Purchase::with('items')
                ->where('user_id', Auth::id())
                ->paginate()
        );
    }

    public function store(StorePurchaseRequest $request)
    {
        $totalAmount = collect($request->input('items'))->reduce(function ($carry, $item) {
            $product = Product::findOrFail($item['product_id']);
            return $carry + ($item['quantity'] * $product->price);
        }, 0);

        $totalAmount = round($totalAmount, 2);

        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
        ]);

        foreach ($request->input('items') as $item) {
            $product = Product::findOrFail($item['product_id']);

            $purchase->items()->create([
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'total' => $item['quantity'] * $product->price,
            ]);
        }

        $purchase->load('items');

        return response()->json([
            'message' => 'Purchase created successfully',
            'purchase' => new PurchaseResource($purchase),
        ]);
    }

    public function show(Purchase $purchase)
    {
        $purchase->load('items'); // Завантаження зв'язанних елементів до вже створеного екземепляру
        return new PurchaseResource($purchase);
    }

    public function all(Request $request)
    {
        return PurchaseResource::collection(Purchase::with('items')->paginate());
    }

    public function destroy(Purchase $purchase)
    {
        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }

        foreach ($purchase->items as $item) {
            $item->delete();
        }

        $purchase->delete();

        return response()->json(['message' => 'Purchase and related items deleted successfully']);
    }
}