<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Compare;
use App\Models\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
     public function AddToCompare($property_id){
        try {
            if(Auth::check() && Auth::user()->role === 'user'){

                $exists = Compare::where('user_id',Auth::id())->where('property_id',$property_id)->first();

                if (!$exists) {
                    Compare::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now()
                    ]);
                    return response()->json(['success' => 'Successfully Added On Your Compare']);
                }else{
                    return response()->json(['error' => 'This Property Has Already in your CompareList']);
                }

            }else{
                return response()->json(['error' => 'At First Login Your Account']);
            }
        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }


    } // End Method

    public function UserCompare(){

        try {
            $page_title = 'Compare Property';
            $uId = Auth::user()->id;
            $compare = Compare::with('property')->where('user_id',$uId)->latest()->get();
            return view('frontend.dashboard.compare',compact('page_title','compare'));

        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }

    }// End Method
    public function getCompareProperty() {

        try {

            $currency_symbol = SiteSetting::find(1);
            $currency = $currency_symbol->currency_symbol;

            $uId = Auth::user()->id;
            // Fetch the comparison data with associated properties
            $compare = Compare::with('property')->where('user_id', $uId)->latest()->get();
            // Combine data from different models
            return response()->json(['compare' =>$compare, 'currency' => $currency]);


        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }
    }

    public function CompareRemove($id){

        try {

            $uId = Auth::user()->id;
            Compare::where('user_id',$uId)->where('id',$id)->delete();
            return response()->json(['success' => 'Successfully Property Remove']);

        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }
      }// End Method

}
