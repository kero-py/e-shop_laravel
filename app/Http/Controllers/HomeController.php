<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Stripe;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(3);
        $comment=comment::orderby('id', 'desc')->get();
        $reply=reply::all();
        return view('home.userpage', compact('product', 'comment', 'reply'));
    }

    public function all_products()
    {
        $product=Product::all();
        return view('home.all_products', compact('product'));
    }

    public function product_details($id)
    {
        $product=product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();

            $total_revenue=0;
            $order=order::all();
            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered=order::where('delivery_status', '=', 'delivered')->get()->count();

            $total_processing=order::where('delivery_status', '=', 'processing')->get()->count();

            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        }

        else
        {   
            $product=Product::paginate(3);

            $comment=comment::orderby('id', 'desc')->get();
            $reply=reply::all();
            return view('home.userpage', compact('product', 'comment', 'reply'));
            /* return view('home.userpage'); */
        }
    }

    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            /* return redirect()->back(); */
            $user=Auth::user();

            $product=product::find($id);

            /* dd($product); */

            $cart=new cart;

            $cart->name=$user->name;

            $cart->email=$user->email;

            $cart->phone=$user->phone;

            $cart->address=$user->address;

            $cart->user_id=$user->id;

            $cart->product_title=$product->title;

            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }

            else

            {
                $cart->price=$product->price * $request->quantity;
            }

            $cart->image=$product->image;

            $cart->product_id=$product->id;

            $cart->quantity=$request->quantity;

            $cart->save();

            return redirect()->back();
        }

        else
        {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
        }

        else
        {
            return redirect('login');
        }
    }

    public function show_order()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $order=order::where('user_id', '=', $id)->get(); 
            return view('home.order', compact('order'));
        }

        else
        {
            return redirect('login');
        }
    }

    public function remove_item($id)
    {
        $cart=cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function cancel_order($id)
    {
        $order=order::find($id);

        $order->delivery_status='cancelled';

        $order->save();

        return redirect()->back();
    }

    public function cash_order()
    {
        $user=Auth::user();

        $userid=$user->id;

        /* dd($userid); */

        $data=cart::where('user_id', '=', $userid)->get();

        /* dd($data); */

        foreach($data as $data)
        {
            $order=new order;

            $order->name=$data->name;
            $order->email=$data->email;
            $order->address=$data->address;
            $order->phone=$data->phone;
            $order->user_id=$data->user_id;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='cash - pending';
            $order->delivery_status='processing';

            $order->save();

            $item_id=$data->id;
            $cart=cart::find($item_id);
            $cart->delete();
        }

        return redirect()->back()->with('message', 'Thanks, we have received your order for processing. We shall be in contact with you soon.');
    }

    public function stripe($total_price)
    {
        return view('home.stripe', compact('total_price'));
    }

    public function stripePost(Request $request, $total_price)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $total_price * 100,

                "currency" => "gbp",

                "source" => $request->stripeToken,

                "description" => "Thank you for your payment." 

        ]);

        $user=Auth::user();

        $userid=$user->id;

        /* dd($userid); */

        $data=cart::where('user_id', '=', $userid)->get();

        /* dd($data); */

        foreach($data as $data)
        {
            $order=new order;

            $order->name=$data->name;
            $order->email=$data->email;
            $order->address=$data->address;
            $order->phone=$data->phone;
            $order->user_id=$data->user_id;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->payment_status='paid';
            $order->delivery_status='processing';

            $order->save();

            $item_id=$data->id;
            $cart=cart::find($item_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

              

        return back();

    }

    public function search_product (Request $request)
    {
        $searchQuery=$request->search;
        $product=product::where('title', 'LIKE', "%$searchQuery%")
        ->orWhere('description', 'LIKE', "%$searchQuery%")
        ->orWhere('id', "$searchQuery")->get();

        return view('home.all_products', compact('product'));
    }

    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment=new comment;

            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;

            $comment->save();

            return redirect()->back();
        }

        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply=new reply;

            $reply->name=Auth::user()->name;
            $reply->user_id=Auth::user()->id;
            $reply->comment_id=$request->commentID;
            $reply->reply=$request->reply;

            $reply->save();

            return redirect()->back();

        }

        else
        {
            return redirect('login');
        }
    }

    public function coming_soon()
    {
        return view('home.coming_soon');
    }
}




