<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class OrderController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $user = JWTAuth::user();

        $productList = [];
        foreach ($data['id'] as $id) {
            $productList[] = Product::find($id)->id;
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id
            ]);
            $order->product()->sync($productList);

        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return response()->json([
            'order' => $order
        ], 200);
    }


}
