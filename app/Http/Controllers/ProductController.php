<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function purchase(Request $request, Product $product)
    {
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($product->price * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with('message', 'Product purchased successfully!');
    }
}
