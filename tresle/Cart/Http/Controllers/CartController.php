<?php


namespace Tresle\Cart\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Tresle\Cart\Model\Cart;
use Tresle\Cart\Model\CartQuery;

class CartController extends Controller
{

    public function store(\Tresle\Cart\Http\Requests\CartRequest $request)
    {
        try {
            $user = Auth::user();
            $cart = new CartQuery();
            $cart->insert($request, $user->id);
            return ["error" => false, "message" => "", "data" => $cart];
        } catch (ModelNotFoundException $e) {
            return ["error" => true, "message" => "Erro ao inserir item no carrinho"];
        }catch (\Illuminate\Database\QueryException $e) {
            return ["error" => true, "message" => $e->getMessage()];
        }
    }
}