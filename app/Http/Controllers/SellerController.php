<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seller']);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $total_orders = Order::where('seller_id', $user->id)->count();
        $total_products = Product::where('seller_id', $user->id)->count();
        $total_revenue = Order::where('seller_id', $user->id)
                            ->where('payment_status', 'paid')
                            ->sum('total_amount');
        
        $recent_orders = Order::where('seller_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        
        return view('seller.dashboard', compact('total_orders', 'total_products', 'total_revenue', 'recent_orders'));
    }

    public function products()
    {
        $products = Product::where('seller_id', Auth::id())
                         ->with('category')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        return view('seller.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::where('status', 'active')->get();
        return view('seller.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'cat_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['seller_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title);
        $data['discount'] = 0;
        $data['is_featured'] = 0;
        $data['is_approved'] = false;
        $data['status'] = 'inactive';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move('storage/photos/1/Products', $filename);
            $data['photo'] = '/storage/photos/1/Products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('seller.products')->with('success', 'Product created successfully. Waiting for admin approval.');
    }

    public function editProduct($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        $categories = Category::where('status', 'active')->get();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'cat_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Only allow status change if product is approved
        if (!$product->is_approved) {
            unset($data['status']);
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move('storage/photos/1/Products', $filename);
            $data['photo'] = '/storage/photos/1/Products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('seller.products')->with('success', 'Product updated successfully');
    }

    public function destroyProduct($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Product deleted successfully');
    }

    public function orders()
    {
        $orders = Order::where('seller_id', Auth::id())->paginate(10);
        return view('seller.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::where('seller_id', Auth::id())->findOrFail($id);
        return view('seller.orders.show', compact('order'));
    }
} 