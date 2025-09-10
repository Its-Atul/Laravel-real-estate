<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\PropertyMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    public function AgentDashboard()
    {

        try{

            $id = Auth::user()->id;
            $property = Property::where('agent_id', $id)->latest()->take(10)->get();
            $propertyMessage = PropertyMessage::where('agent_id', $id)->latest()->take(10)->get();
            $schedule = Schedule::where('agent_id', $id)->latest()->take(10)->get();
            return view('agent.index',compact('property','schedule','propertyMessage'));

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $errorMessage = $e->getMessage();
            $notification = [
                'message' => 'An error occurred while loading the dashboard.'.$errorMessage,
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method

    public function AgentLogout(Request $request)
    {
        try{

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $notification = array(
                'message' => 'Agent Logout Successfully',
                'alert-type' => 'success'
            );

            return redirect('/login')->with($notification);

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $errorMessage = $e->getMessage();
            $notification = [
                'message' => 'An error occurred while loading the dashboard.'.$errorMessage,
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method

    public function AgentProfile()
    {

        try{

            $id = Auth::user()->id;
            $profileData = User::find($id);
            return view('agent.agent_profile',compact('profileData'));

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $errorMessage = $e->getMessage();
            $notification = [
                'message' => 'An error occurred while loading the dashboard.'.$errorMessage,
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

     }// End Method

    public function AgentProfileStore(Request $request)
    {
        // Define custom error messages
        $customMessages = [
            'username.required' => 'The username is required.',
            'username.max' => 'The username must not exceed 255 characters.',
            'name.required' => 'The name is required.',
            'name.max' => 'The name must not exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email address must not exceed 255 characters.',
            'phone.required' => 'The phone number is required.',
            'phone.numeric' => 'The phone number must be a numeric value.',
            'phone.digits' => 'The phone number must have exactly 10 digits.',
            'address.max' => 'The address must not exceed 255 characters.',
            'about.max' => 'The about field must not exceed 500 characters.',
            'facebook.url' => 'Please provide a valid Facebook URL.',
            'youtube.url' => 'Please provide a valid YouTube URL.',
            'twitter.url' => 'Please provide a valid Twitter URL.',
            'instagram.url' => 'Please provide a valid Instagram URL.',
            'photo.image' => 'Please upload a valid image file.',
            'photo.mimes' => 'Only JPEG, PNG, JPG, and GIF image files are allowed.',
            'photo.max' => 'The image must not exceed 2048 kilobytes (2 MB).',
        ];

        // Validate the incoming request data with custom messages
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits:10',
            'address' => 'nullable|max:255',
            'about' => 'nullable|max:1000',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $customMessages);

        // If validation fails, return the validation errors
        if ($validator->fails()) {

            $notification = [
                'message' => 'Validation failed : ' . $validator->errors()->first(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            $id = Auth::user()->id;
            $data = User::find($id);
            $data->username = $request->username;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->about = $request->about;
            $data->facebook = $request->facebook;
            $data->youtube = $request->youtube;
            $data->twitter = $request->twitter;
            $data->instagram = $request->instagram;

            if ($request->file('photo')) {
                $file = $request->file('photo');
                @unlink(public_path('upload/admin_images/'.$data->photo));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'),$filename);
                $data['photo'] = $filename;
            }

            $data->save();

            // Commit the transaction if all operations are successful
            DB::commit();


            $notification = array(
                'message' => 'Agent Profile Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            DB::rollback();

            $notification = [
                'message' => 'An error occurred: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }// End Method


    public function AgentChangePassword()
    {

            try {

                $id = Auth::user()->id;
                $profileData = User::find($id);
                return view('agent.change_password',compact('profileData'));

            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                $notification = [
                    'message' => 'An error occurred while loading the change password page.'.$e->getMessage(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

    }// End Method


    public function AgentUpdatePassword(Request $request)
    {

        try {
            // Custom validation messages
            $customMessages = [
                'old_password.required' => 'Please enter the old password.',
                'new_password.required' => 'Please enter the new password.',
                'new_password.confirmed' => 'The new password confirmation does not match.',
            ];

            // Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed'
            ], $customMessages);

            /// Match The Old Password

            // Start a database transaction
            DB::beginTransaction();

            if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
            }

            /// Update The New Password

            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)

            ]);

            // Commit the transaction if all operations are successful
            DB::commit();

            $notification = array(
                'message' => 'Password Change Successfully',
                'alert-type' => 'success'
            );

            return back()->with($notification);

        } catch (\Exception $e) {

            // Roll back the transaction in case of an exception
            DB::rollback();
            // Handle any exceptions that may occur
            $notification = [
                'message' => 'An error occurred while updating the password. Please try again.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }

    }// End Method

}
