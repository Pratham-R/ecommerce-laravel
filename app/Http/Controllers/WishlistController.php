<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function wishlist(Request $request){
        if (empty($request->slug)) {
            if($request->ajax()){
                return response()->json(['status' => false, 'msg' => 'Invalid Products']);
            }
            request()->session()->flash('error','Invalid Products');
            return back();
        }        
        $product = Product::where('slug', $request->slug)->first();
        if (empty($product)) {
            if($request->ajax()){
                return response()->json(['status' => false, 'msg' => 'Invalid Products']);
            }
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        $already_wishlist = Wishlist::where('user_id', auth()->user()->id)->where('cart_id',null)->where('product_id', $product->id)->first();
        if($already_wishlist) {
            if($request->ajax()){
                return response()->json(['status' => false, 'msg' => 'You already placed in wishlist']);
            }
            request()->session()->flash('error','You already placed in wishlist');
            return back();
        }else{
            $wishlist = new Wishlist;
            $wishlist->user_id = auth()->user()->id;
            $wishlist->product_id = $product->id;
            $wishlist->price = ($product->price-($product->price*$product->discount)/100);
            $wishlist->quantity = 1;
            $wishlist->amount=$wishlist->price*$wishlist->quantity;
            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) {
                if($request->ajax()){
                    return response()->json(['status' => false, 'msg' => 'Stock not sufficient!']);
                }
                return back()->with('error','Stock not sufficient!.');
            }
            $wishlist->save();
        }
        if($request->ajax()){
            $wishlist_count = Wishlist::where('user_id', auth()->user()->id)->count();
            return response()->json(['status' => true, 'msg' => 'Product successfully added to wishlist', 'count' => $wishlist_count]);
        }
        request()->session()->flash('success','Product successfully added to wishlist');
        return back();       
    }  
    
    public function wishlistDelete(Request $request){
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            request()->session()->flash('success','Wishlist successfully removed');
            return back();  
        }
        request()->session()->flash('error','Error please try again');
        return back();       
    }     
}
