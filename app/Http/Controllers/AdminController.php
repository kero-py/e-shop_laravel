<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;

use PDF;

class AdminController extends Controller
{
    public function view_category()
    {
        $data=category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data=new category;

        $data->category_name=$request->category;

        $data->save();

        return redirect()->back()->with('message', 'Category added successfully! You may now close this tab.');
    }

    public function delete_category($id)
    {
        $data=category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category deleted successfully! You may now close this tab.');
    }

    public function view_product()
    {
        $category=category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product=new product;

        $product->title=$request->product_name;
        $product->description=$request->product_description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->category=$request->category_name;

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product', $imagename);

        $product->image=$imagename;

        $product->save();
        
        return redirect()->back()->with('message', 'Product added successfully!');
    }

    public function show_product()
    {
        $product=product::all();
        return view('admin.show_product', compact('product'));
    }

    public function delete_product($id)
    {
        $product=product::find($id);

        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully!');
    }

    public function edit_product($id)
    {
        $product=product::find($id);

        $category=category::all();

        return view('admin.edit_product', compact('product', 'category'));
    }

    public function edit_product_save (Request $request, $id)
    {
        $product=product::find($id);
        $product->title=$request->product_name;
        $product->description=$request->product_description;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->quantity=$request->quantity;
        $product->category=$request->category_name;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image=$imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product updated successfully!');
    }

    public function order()
    {
        $order=order::all();

        return view('admin.order', compact('order'));
    }

    public function actioned($id)
    {
        $order=order::find($id);
        $order->delivery_status="delivered";
        $order->payment_status='paid';
        $order->save();
        
        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order=order::find($id);

        $pdf=PDF::loadView('admin.pdf', compact('order'));

        return $pdf->download('order_details');
    }

    public function search_order(Request $request)
    {
        $searchQuery=$request->search;
        $order=order::where('name', 'LIKE', "%$searchQuery%")
        ->orWhere('phone', "%$searchQuery%")
        ->orWhere('address', 'LIKE', "%$searchQuery%")
        ->orWhere('product_title', 'LIKE', "%$searchQuery%")
        ->orWhere('payment_status', 'LIKE', "%$searchQuery%")
        ->orWhere('delivery_status', 'LIKE', "%$searchQuery%")
        ->orWhere('product_id', "$searchQuery")->get();

        return view('admin.order', compact('order'));
    }
}
