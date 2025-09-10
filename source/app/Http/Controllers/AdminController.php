<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Property;
use App\Models\Schedule;
use App\Models\PackagePlan;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\PropertyMessage;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AdminController extends Controller
{
    public function AdminDashboard()
    {
        try {

            $currency_symbol = SiteSetting::find(1);

            // Calculate the start and end date of the previous month
            $startDate = Carbon::now()->subMonth()->startOfMonth();
            $endDate = Carbon::now()->subMonth()->endOfMonth();

            // Count of agents
            $agentCount = User::where('role', 'agent')->count();

            // Count of users
            $userCount = User::where('role', 'user')->count();

            // Fetch monthly user registrations
            $monthlyUserRegistrations = User::where('role', 'user')
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%b %d %Y") as month'),
                    DB::raw('COUNT(*) as registrations')
                )
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b %d %Y")'))
                ->get();

            // Fetch monthly agent registrations
            $monthlyAgentRegistrations = User::where('role', 'agent')
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%b %d %Y") as month'),
                    DB::raw('COUNT(*) as registrations')
                )
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b %d %Y")'))
                ->get();

            // Fetch the count of users registered in the previous month
            $previousUserMonthCount = User::whereBetween('created_at', [$startDate, $endDate])
                ->where('role', 'user')
                ->count();

            // Fetch the count of agents registered in the previous month
            $previousAgentMonthCount = User::whereBetween('created_at', [$startDate, $endDate])
                ->where('role', 'agent')
                ->count();

            // Fetch the count of users registered in the current month
            $currentUserMonthCount = User::whereMonth('created_at', now()->month)
                ->where('role', 'user')
                ->count();

            // Fetch the count of agents registered in the current month
            $currentAgentMonthCount = User::whereMonth('created_at', now()->month)
                ->where('role', 'agent')
                ->count();

            // Calculate user growth percentage
            $growthUserPercentage = $previousUserMonthCount != 0 ? (($currentUserMonthCount - $previousUserMonthCount) / $previousUserMonthCount) * 100 : 0;

            // Determine user growth class and arrow icon
            $growthUserClass = $growthUserPercentage < 0 ? 'text-danger' : 'text-success';
            $arrowUserIcon = $growthUserPercentage < 0 ? 'arrow-down' : 'arrow-up';

            // Calculate agent growth percentage
            $growthAgentPercentage = $previousAgentMonthCount != 0 ? (($currentAgentMonthCount - $previousAgentMonthCount) / $previousAgentMonthCount) * 100 : 0;

            // Determine Agent growth class and arrow icon
            $growthAgentClass = $growthAgentPercentage < 0 ? 'text-danger' : 'text-success';
            $arrowAgentIcon = $growthAgentPercentage < 0 ? 'arrow-down' : 'arrow-up';

            // Fetch monthly revenue data
            $monthlyRevenue = PackagePlan::select(
                DB::raw('DATE_FORMAT(created_at, "%b %Y") as month_year'),
                DB::raw('SUM(package_amount) as total_revenue')
            )
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%b %Y")'))
                ->get();

            // Fetch monthly sales data
            $monthlySales = PackagePlan::select(
                DB::raw('DATE_FORMAT(created_at, "%b %Y") as formatted_date'),
                DB::raw('COUNT(*) as sales_count')
            )
                ->whereYear('created_at', Carbon::now()->year)
                ->groupBy(DB::raw('MONTH(created_at)'), 'formatted_date')
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();

            // Fetch recent property messages
            $propertyMessage = PropertyMessage::latest()->take(15)->get();

            // Fetch recent properties
            $property = Property::latest()->take(10)->get();

            // Fetch recent schedules
            $schedule = Schedule::latest()->take(10)->get();


            // Pass data to the view
            return view('admin.index', compact('monthlySales','currency_symbol', 'monthlyRevenue', 'property', 'schedule', 'propertyMessage', 'agentCount', 'userCount', 'growthAgentPercentage', 'growthAgentClass', 'arrowAgentIcon', 'growthUserClass', 'arrowUserIcon', 'growthUserPercentage', 'monthlyUserRegistrations', 'monthlyAgentRegistrations'));

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $errorMessage = $e->getMessage();
            $notification = [
                'message' => 'An error occurred while loading the admin dashboard. ' . $errorMessage,
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method


    public function AdminLogout(Request $request)
    {
        try {
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                $notification = array(
                    'message' => 'Admin Logout Successfully',
                    'alert-type' => 'success'
                );

                return redirect('login')->with($notification);

            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                $errorMessage = $e->getMessage();
                $notification = [
                    'message' => $errorMessage,
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }
    } //End Method

    public function AdminProfile()
    {
        try {

            $id = Auth::user()->id;
            $profileData = User::find($id);
            return view('admin.admin_profile', compact('profileData'));

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $errorMessage = $e->getMessage();
            $notification = [
                'message' => $errorMessage,
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;

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

         // Use a database transaction to ensure atomicity
        try {
            DB::transaction(function () use ($id, $request) {
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
                    @unlink(public_path('upload/admin_images/' . $data->photo));
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('upload/admin_images'), $filename);
                    $data['photo'] = $filename;
                }

                $data->save();
            });

            $notification = [
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the transaction
            $notification = [
                'message' => 'An error occurred during the update. Please try again.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminChangePassword()
    {
        try {

            $id = Auth::user()->id;
            $profileData = User::find($id);
            return view('admin.change_password', compact('profileData'));

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $notification = [
                'message' => 'An error occurred while loading the change password page.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminUpdatePassword(Request $request)
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

            // Match The Old Password
            if (!Hash::check($request->old_password, Auth::user()->password)) {
                $notification = [
                    'message' => 'Old Password Does not Match!',
                    'alert-type' => 'error'
                ];
                return back()->with($notification);
            }

            // Update The New Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            $notification = [
                'message' => 'Password Change Successfully',
                'alert-type' => 'success'
            ];

            return back()->with($notification);

        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            $notification = [
                'message' => 'An error occurred while updating the password. Please try again.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }

    } // End Method

    public function AllAgent()
    {
        try {

            $allagent = User::where('role', 'agent')->get();
            return view('backend.agentuser.all_agent', compact('allagent'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in All Agent method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }
    } // End Method



    public function AgentDetails($encryptedId)
    {

        try {
                $id = decrypt($encryptedId);
                $agent = User::findOrFail($id);
                return view('backend.agentuser.details_agent', compact('agent'));

            } catch (\Exception $e) {

                    // Handle the exception, you might want to log it or provide a generic error message
                    $notification = [
                        'message' => 'Query exception in Edit Agent method: ' .$e->getMessage(),
                        'alert-type' => 'error'
                    ];

                    return redirect()->back()->with($notification);

            }

    }
    public function DeleteAgent($encryptedId)
    {

        try {
                $id = decrypt($encryptedId);
                // Start a database transaction
                DB::beginTransaction();

                User::findOrFail($id)->delete();

                // Commit the transaction
                DB::commit();
                $notification = array(
                    'message' => 'Agent Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            } catch (\Exception $e) {

                // Rollback the transaction in case of an exception
                DB::rollBack();

                // Handle the exception, log it, and return an error response
                $notification = array(
                    'message' => 'Error deleting testimonial'.$e->getMessage(),
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
    } // End Method
    public function changeStatus(Request $request)
    {

        try {

            $user = User::find($request->user_id);
            $user->status = $request->status;
            $user->save();
            return response()->json(['success' => 'Status Change Successfully']);

        } catch (\Exception $e) {

            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, log it, and return an error response
            $notification = array(
                'message' => 'Error Change Status'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AllUser()
    {
        try {

            $alluser = User::where('role', 'user')->get();
            return view('backend.user.all_user', compact('alluser'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in All Agent method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }
    } // End Method

    public function UserDetails($encryptedId)
    {

        try {
                $id = decrypt($encryptedId);
                $user = User::findOrFail($id);
                return view('backend.user.details', compact('user'));

            } catch (\Exception $e) {

                    // Handle the exception, you might want to log it or provide a generic error message
                    $notification = [
                        'message' => 'Query exception in Edit Agent method: ' .$e->getMessage(),
                        'alert-type' => 'error'
                    ];

                    return redirect()->back()->with($notification);

            }

    }
    public function DeleteUser($encryptedId)
    {

        try {
                $id = decrypt($encryptedId);
                // Start a database transaction
                DB::beginTransaction();

                User::findOrFail($id)->delete();

                // Commit the transaction
                DB::commit();
                $notification = array(
                    'message' => 'Agent Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            } catch (\Exception $e) {

                // Rollback the transaction in case of an exception
                DB::rollBack();

                // Handle the exception, log it, and return an error response
                $notification = array(
                    'message' => 'Error deleting testimonial'.$e->getMessage(),
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
    } // End Method
    public function changeUserStatus(Request $request)
    {

        try {

            $user = User::find($request->user_id);
            $user->status = $request->status;
            $user->save();
            return response()->json(['success' => 'Status Change Successfully']);

        } catch (\Exception $e) {

            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, log it, and return an error response
            $notification = array(
                'message' => 'Error Change Status'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AllAdmin()
    {

        try{

            $alladmin = User::where('role', 'admin')->get();
            return view('backend.pages.admin.all_admin', compact('alladmin'));

        } catch (\Exception $e) {

            // Handle the exception, log it, and return an error response
            $notification = array(
                'message' => 'Error All Admin'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AddAdmin()
    {
           try{
               $roles = Role::orderBy('name','ASC')->get();
               return view('backend.pages.admin.add_admin', compact('roles'));
           } catch (\Exception $e) {

               // Handle the exception, log it, and return an error response
               $notification = array(
                   'message' => 'Error Add Admin'.$e->getMessage(),
                   'alert-type' => 'error'
               );

               return redirect()->back()->with($notification);
           }
    } // End Method


    public function StoreAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'new_password' => 'required|confirmed|min:8',
            'roles' => 'required',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'phone.required' => 'The phone field is required.',
            'phone.digits' => 'Invalid phone number format.',
            'phone.min' => 'The phone number must be at least 10 digits.',
            'address.required' => 'The address field is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'new_password.required' => 'The password field is required.',
            'new_password.confirmed' => 'The password confirmation does not match.',
            'new_password.min' => 'The password must be at least 8 characters.',
            'roles.required' => 'The roles field is required.',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Insert data into the database within the transaction
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = Hash::make($request->new_password);
            $user->role = 'admin';
            $user->status = 'active';
            $user->save();

            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'New Admin User Inserted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.admin')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }


    public function EditAdmin($encryptedId){

        try{
            $id = decrypt($encryptedId);
            $user = User::findOrFail($id);
            $roles = Role::all();
            return view('backend.pages.admin.edit_admin',compact('user','roles'));

        } catch (\Exception $e) {

            // Handle the exception, log it, and return an error response
            $notification = array(
                'message' => 'Error Edit Admin'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

    }// End Method

    public function UpdateAdmin(Request $request,$id){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'roles' => 'required',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'phone.required' => 'The phone field is required.',
            'phone.digits' => 'Invalid phone number format.',
            'phone.min' => 'The phone number must be at least 10 digits.',
            'address.required' => 'The address field is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'roles.required' => 'The roles field is required.',
        ]);


        try {
            // Start a database transaction
            DB::beginTransaction();

            // Insert data into the database within the transaction
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->role = 'admin';
            $user->status = 'active';
            $user->save();

            $user->roles()->detach();
            if ($request->roles) {
                $user->assignRole($request->roles);
            }

            // Commit the transaction
            DB::commit();

            $notification = array(
                    'message' => 'New Admin User Updated Successfully',
                    'alert-type' => 'success'
                );

            return redirect()->route('all.admin')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
                $notification = [
                    'message' => 'Error: ' . $e->getMessage(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
        }

    }// End Method

    public function DeleteAdmin($encryptedId)
{
    try {
        $id = decrypt($encryptedId);
        // Start a database transaction
        DB::beginTransaction();

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Admin User Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        }

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => 'Error: ' . $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
}// End Method



}
