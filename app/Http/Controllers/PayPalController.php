<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Post;
use App\Models\Promote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function userPromoteAdd(Request $request)
    {
        $request->validate([
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'package_id' => ['sometimes', 'required', 'integer', 'exists:packages,id'],
            'package_ids' => ['sometimes', 'required', 'array']
        ]);

        $post = Post::find($request->post_id);
        if ($post->user_id != auth()->id())
            return redirect()->back()->with('message', 'You don\'t own this post!');

        $product = [];
        $order = [];
        $total = 0;

        if ($request->has('package_id')) {
            $package = Package::find($request->package_id);
            $product['items'] = [
                [
                    'name' => $package->title . " " . $package->price,
                    'price' => $package->price,
                    'desc'  => $package->detail,
                    'qty' => 1
                ]
            ];
            $order = [
                'post_id' => $request->post_id,
                'package_id' => $package->id,
                'price' => $package->price
            ];
            $total = $package->price;
        } else if ($request->has('package_ids')) {
            $packages = Package::whereIn('id', $request->package_ids)->get();
            $items = [];
            foreach ($packages as $package) {
                $items[] = [
                    'name' => $package->title . " " . $package->price,
                    'price' => $package->price,
                    'desc'  => $package->detail,
                    'qty' => 1
                ];
                $order[] = [
                    'post_id' => $request->post_id,
                    'package_id' => $package->id,
                    'price' => $package->price
                ];
                $total += $package->price;
            }
            $product['items'] = $items;
        } else
            return redirect()->back()->with('message', 'Please add a package');

        session([
            'order' => $order
        ]);

        $product['invoice_id'] = uniqid();
        $product['invoice_description'] = "Invoice - " . $product['invoice_id'];
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = $total;

        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product, false, true);
        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        session()->forget("order");

        return redirect('home')->with("message", "Order canceled!");
    }

    public function paymentSuccess(Request $request, $isFree = FALSE)
    {
        if (!$isFree) {
            $paypalModule = new ExpressCheckout;
            $response = $paypalModule->getExpressCheckoutDetails($request->token);
        }

        if (!session()->has('order')) {
            return abort(403, "No product found in your session.");
        }

        $order = session()->get('order');

        if ($isFree || in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            foreach ($order as $row)
                Promote::create([
                    'user_id' => auth()->id(),
                    'post_id' => $row['post_id'],
                    'package_id' => $row['package_id'],
                    'price' => $row['price'],
                    'status' => TRUE
                ]);

            session()->forget("order");

            return redirect('user-promotes')->with('message', 'Promote added successfully!');
        }

        return redirect('user-promotes')->with('message', 'Error occurred!');
    }
}
