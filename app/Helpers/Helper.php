<?php

namespace App\Helpers;

use App\Models\Message;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Shipping;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderBy('created_at', 'desc')->get();
    }
    
    public static function getAllCategory()
    {
        $category = new Category();
        $menu = $category->getAllParentWithChild();
        return $menu;
    }

    public static function getHeaderCategory()
    {
        $category = new Category();
        $menu = $category->getAllParentWithChild();

        if ($menu) {
            $html = '<li class="{{Request::path()=="home" ? "active" : ""}}"><a href="'.route('home').'">Home</a></li>';
            $html .= '<li class="{{Request::path()=="about-us" ? "active" : ""}}"><a href="'.route('about-us').'">About Us</a></li>';
            $html .= '<li class="@if(Request::path()=="product-grids"||Request::path()=="product-lists") active @endif"><a href="'.route('product-grids').'">Products</a><span class="new">New</span></li>';
            
            $html .= '<li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                    Category <i class="ti-angle-down"></i>
                </a>
                <ul class="dropdown-menu border-0 shadow">';
            
            foreach ($menu as $cat_info) {
                if ($cat_info->child_cat->count() > 0) {
                    $html .= '<li class="dropdown-submenu">
                        <a href="' . route('product-cat', $cat_info->slug) . '" class="dropdown-item dropdown-toggle">
                            ' . $cat_info->title . '
                        </a>
                        <ul class="dropdown-menu border-0 shadow">';
                    
                    foreach ($cat_info->child_cat as $sub_menu) {
                        $html .= '<li>
                            <a class="dropdown-item" href="' . route('product-sub-cat', [$cat_info->slug, $sub_menu->slug]) . '">
                                ' . $sub_menu->title . '
                            </a>
                        </li>';
                    }
                    
                    $html .= '</ul></li>';
                } else {
                    $html .= '<li><a class="dropdown-item" href="' . route('product-cat', $cat_info->slug) . '">
                        ' . $cat_info->title . '
                    </a></li>';
                }
            }
            
            $html .= '</ul></li>';
            return $html;
        }
        
        return '';
    }

    public static function productCategoryList($option = 'all')
    {
        if ($option = 'all') {
            return Category::orderBy('id', 'DESC')->get();
        }
        return Category::has('products')->orderBy('id', 'DESC')->get();
    }

    public static function postTagList($option = 'all')
    {
        if ($option = 'all') {
            return PostTag::orderBy('id', 'desc')->get();
        }
        return PostTag::has('posts')->orderBy('id', 'desc')->get();
    }

    public static function postCategoryList($option = "all")
    {
        if ($option = 'all') {
            return PostCategory::orderBy('id', 'DESC')->get();
        }
        return PostCategory::has('posts')->orderBy('id', 'DESC')->get();
    }

    public static function cartCount($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('quantity');
        } else {
            return 0;
        }
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public static function getAllProductFromCart($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Cart::with('product')->where('user_id', $user_id)->where('order_id', null)->get();
        } else {
            return 0;
        }
    }

    public static function totalCartPrice($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('amount');
        } else {
            return 0;
        }
    }

    public static function wishlistCount($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Wishlist::where('user_id', $user_id)->where('cart_id', null)->sum('quantity');
        } else {
            return 0;
        }
    }

    public static function getAllProductFromWishlist($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Wishlist::with('product')->where('user_id', $user_id)->where('cart_id', null)->get();
        } else {
            return 0;
        }
    }

    public static function totalWishlistPrice($user_id = '')
    {
        if (Auth::check()) {
            if ($user_id == "") $user_id = auth()->user()->id;
            return Wishlist::where('user_id', $user_id)->where('cart_id', null)->sum('amount');
        } else {
            return 0;
        }
    }

    public static function grandPrice($id, $user_id)
    {
        $order = Order::find($id);
        if ($order) {
            $shipping_price = (float)$order->shipping->price;
            $order_price = self::orderPrice($id, $user_id);
            return number_format((float)($order_price + $shipping_price), 2, '.', '');
        } else {
            return 0;
        }
    }

    public static function earningPerMonth()
    {
        $month_data = Order::where('status', 'delivered')->get();
        $price = 0;
        foreach ($month_data as $data) {
            $price = $data->cart_info->sum('price');
        }
        return number_format((float)($price), 2, '.', '');
    }

    public static function shipping()
    {
        return Shipping::orderBy('id', 'DESC')->get();
    }
}