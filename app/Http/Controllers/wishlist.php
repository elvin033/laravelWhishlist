<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add()
    {
        $wishlist = session()->get('wishlist', []);
        $product = ["product_id" => 4, "name" => "products-4", "price" => 300];
        $wishlist[$product['product_id']] = $product;
        session()->put('wishlist', $wishlist);
        Wishlist::create($product);

        return response(["message" => "ok"]);
    }

    public function delete($id)
    {
        $wishlist = session()->get('wishlist', []);
        if (!isset($wishlist[$id])) {

            return response(["message" => "not found"]);
        }
        unset($wishlist[$id]);
        Wishlist::where('product_id', $id)->delete();
        session()->put('wishlist', $wishlist);

        return response(["message" => "success deleted {$id}"]);
    }

    public function clear()
    {
        session()->forget('wishlist');
        Wishlist::query()->delete();
        return response(["message" => "success deleted all"]);
    }

    public function getAllProducts()
    {
        $wishlist = session()->get('wishlist', []);
        return response(['wisthlist' => $wishlist]);
    }
    public function get($id)
    {
        $item = [];

        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$id]) || !empty($wishlist)) {

            $item = $wishlist[$id];
        }
        return response(['wisthlist' => $item]);

    }
}
