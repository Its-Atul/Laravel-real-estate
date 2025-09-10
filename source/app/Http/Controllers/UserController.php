<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Compare;
use App\Models\Schedule;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        try {

            return view('frontend.index');

        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => 'Error index function. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }
    }
    public function UserDashboard(){

        try {

            $page_title = 'Dashboard';
            $uId = Auth::user()->id;
            $wishlistCount = Wishlist::where('user_id',$uId)->count();
            $compareCount = Compare::where('user_id',$uId)->count();
            $scheduleTour = Schedule::where('user_id',$uId)->latest()->take(10)->get();
            return view('dashboard',compact('scheduleTour','page_title','wishlistCount','compareCount'));
        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => 'Error UserDashboard. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }
    }

    public function UserProfile(){

        try {
            $id = Auth::user()->id;
            $userData = User::find($id);
            $page_title = 'User Profile';
            return view('frontend.dashboard.edit_profile',compact('userData','page_title'));
        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => 'Error UserProfile. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }

    } // End Method

    public function UserProfileStore(Request $request){

        try {

            // Get the authenticated user's ID
            $id = Auth::user()->id;

            // Validate the incoming request data
            $request->validate([
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($id),
                ],
                'phone' => 'required|digits:10',
                'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            ], [
                // Custom error messages for validation rules
                'username.required' => 'The username field is required.',
                'username.unique' => 'The username has already been taken.',
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'The email has already been taken.',
                'phone.required' => 'The phone field is required.',
                'phone.digits' => 'The phone number must be exactly 10 digits.',
                'photo.image' => 'The uploaded file must be an image.',
                'photo.mimes' => 'The uploaded image must be of type: jpeg, png, jpg.',
                'photo.max' => 'The uploaded image may not be greater than 2048 kilobytes.',
            ]);

            // Start a database transaction
            DB::beginTransaction();

            // Find the user by ID
            $data = User::find($id);
            $data->username = $request->username;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;

            // Handle photo upload
            if ($request->file('photo')) {
                $file = $request->file('photo');
                @unlink(public_path('upload/user_images/' . $data->photo));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/user_images'), $filename);
                $data->photo = $filename;
            }

            // Save the user data to the database
            $data->save();

            // Commit the database transaction
            DB::commit();

            // Success notification
            $notification = [
                'message' => 'User Profile Updated Successfully',
                'alert-type' => 'success'
            ];

            // Redirect back with success message
            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Error notification
            $notification = [
                'message' => 'Error updating user profile. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }

    }// End Method

    public function UserLogout(Request $request){

        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $notification = array(
                'message' => 'User Logout Successfully',
                'alert-type' => 'success'
            );
            return redirect('/login')->with($notification);

        } catch (\Exception $e) {

            // Error notification
            $notification = [
                'message' => 'Error UserLogout. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            // Redirect back with error message
            return redirect()->back()->with($notification);
        }
    } // End Method
    public function UserChangePassword(){
        try {

            $page_title = "Change Password";
            return view('frontend.dashboard.change_password',compact('page_title'));

        } catch (\Exception $e) {

                // Error notification
                $notification = [
                    'message' => 'Error UserChangePassword. Please try again.'.$e->getMessage(),
                    'alert-type' => 'error'
                ];

                // Redirect back with error message
                return redirect()->back()->with($notification);
        }

    }// End Method

    public function UserPasswordUpdate(Request $request){

        try {

            // Validation with custom messages
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed'
            ], [
                'old_password.required' => 'The old password field is required.',
                'new_password.required' => 'The new password field is required.',
                'new_password.confirmed' => 'The new password confirmation does not match.'
            ]);

            // Start a database transaction
            DB::beginTransaction();


            // Match the old password
            if (!Hash::check($request->old_password, auth::user()->password)) {
                $notification = [
                    'message' => 'Old Password Does not Match!',
                    'alert-type' => 'error'
                ];

                return back()->with($notification);
            }

            // Update the new password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            // Commit the database transaction
            DB::commit();

            $notification = [
                'message' => 'Password Change Successfully',
                'alert-type' => 'success'
            ];

            return back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            $notification = [
                'message' => 'Error updating password. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }

    }// End Method

    public function UserScheduleRequest(){

        try{

            $id = Auth::user()->id;
            $page_title = 'Tour Schedule';
            $srequest = Schedule::where('user_id',$id)->latest()->get();
            return view('frontend.dashboard.schedule_request',compact('srequest','page_title'));
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            $notification = [
                'message' => 'Error UserScheduleRequest. Please try again.'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }

    } // End Method


}
