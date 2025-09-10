<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishList($property_id){

        if(Auth::check() && Auth::user()->role === 'user'){

            $exists = Wishlist::where('user_id',Auth::id())->where('property_id',$property_id)->first();

            if (!$exists) {
                Wishlist::insert([
                'user_id' => Auth::id(),
                'property_id' => $property_id,
                'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            }else{
                return response()->json(['error' => 'This Property Has Already in your WishList']);
            }

        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        }


    } // End Method

    public function UserWishlist(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        $page_title = 'WishList Property';
        return view('frontend.dashboard.wishlist',compact('userData','page_title'));

    }// End Method
    public function GetWishlistProperty(){

        $wishlist = Wishlist::with('property')->where('user_id',Auth::id())->latest()->get();
        $wishQty = wishlist::count();
        $currency_symbol = SiteSetting::find(1);
        $currency = $currency_symbol->currency_symbol;
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty, 'currency' => $currency]);

    }// End Method

    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Property Remove']);

      }// End Method
}
