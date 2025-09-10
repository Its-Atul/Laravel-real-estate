<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use App\Models\Contact;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use App\Models\TermService;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\package_plan_setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function SmtpSetting()
    {
        try {

            $setting = SmtpSetting::find(1);
            return view('backend.setting.smpt_update', compact('setting'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in smtp setting method'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function UpdateSmtpSetting(Request $request)
    {

            // Validation
            $validator = Validator::make($request->all(), [
                'mailer' => 'required|max:250',
                'host' => 'required|max:250',
                'port' => 'required|max:250',
                'username' => 'required|max:250',
                'password' => 'required|max:250',
                'encryption' => 'required|max:250',
                'from_address' => 'required|max:250',
            ], [
                'mailer.required' => 'The mailer name is required.',
                'mailer.max' => 'The mailer name must not be greater than 250 characters.',
                'host.required' => 'The host is required.',
                'host.max' => 'The host must not be greater than 250 characters.',
                'port.required' => 'The port is required.',
                'port.max' => 'The port must not be greater than 250 characters.',
                'username.required' => 'The username is required.',
                'username.max' => 'The username must not be greater than 250 characters.',
                'password.required' => 'The password is required.',
                'password.max' => 'The password must not be greater than 250 characters.',
                'encryption.required' => 'The encryption is required.',
                'encryption.max' => 'The encryption must not be greater than 250 characters.',
                'from_address.required' => 'The from address is required.',
                'from_address.max' => 'The from address must not be greater than 250 characters.',
            ]);

            if ($validator->fails()) {

                $notification = [
                    'message' => 'Validation failed : ' . $validator->errors()->first(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

        try {

            // Begin a database transaction
            DB::beginTransaction();

            $stmp_id = $request->id;

            // Database insertion
            SmtpSetting::findOrFail($stmp_id)->update([

                'mailer' => $request->mailer,
                'host' => $request->host,
                'port' => $request->port,
                'username' => $request->username,
                'password' => $request->password,
                'encryption' => $request->encryption,
                'from_address' => $request->from_address,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            $notification = array(
                'message' => 'Smtp Setting Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in smtp setting updated method'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function SiteSetting()
    {
        try {

            $sitesetting = SiteSetting::find(1);
            return view('backend.setting.site_update', compact('sitesetting'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in smtp setting updated method: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method
    public function UpdateSiteSetting(Request $request)
    {

            $site_id = $request->id;
            // Validate the request data with custom messages
            $request->validate([
                'support_phone' => 'required|numeric|digits_between:10,12',
                'company_address' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'about' => 'required|string|',
                'open_timming' => 'required|string|max:255',
                'email' => 'required|email',
                'facebook' => 'nullable|url',
                'instagram' => 'nullable|url',
                'youtube' => 'nullable|url',
                'twitter' => 'nullable|url',
                'website' => 'nullable|url',
                'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'side_header_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'footer_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'favicon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'latitude' => 'required',
                'longitude' => 'required',
                'currency_symbol' => 'required',
            ], [
                'support_phone.required' => 'The support phone field is required.',
                'support_phone.digits_between' => 'The support phone must be exactly 10 to 12 digits.',
                'support_phone.numeric' => 'The support phone must be a numeric value.',
                'company_address.required' => 'The company address field is required.',
                'company_address.string' => 'The company address must be a string.',
                'company_address.max' => 'The company address may not be greater than 255 characters.',
                'company_name.required' => 'The company name field is required.',
                'company_name.string' => 'The company name must be a string.',
                'company_name.max' => 'The company name may not be greater than 255 characters.',
                'open_timming.required' => 'The open timing field is required.',
                'open_timming.string' => 'The open timing must be a string.',
                'open_timming.max' => 'The open timing may not be greater than 255 characters.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'facebook.url' => 'Please provide a valid Facebook URL.',
                'website.url' => 'Please provide a valid website URL.',
                'instagram.url' => 'Please provide a valid Instagram URL.',
                'youtube.url' => 'Please provide a valid YouTube URL.',
                'twitter.url' => 'Please provide a valid Twitter URL.',
                'logo.image' => 'The logo must be an image file.',
                'logo.mimes' => 'The logo must be a file of type: png, jpg, jpeg.',
                'logo.max' => 'The logo may not be greater than 2 MB.',
                'side_header_logo.image' => 'The side header logo must be an image file.',
                'side_header_logo.mimes' => 'The side header logo must be a file of type: png, jpg, jpeg.',
                'side_header_logo.max' => 'The side header logo may not be greater than 2 MB.',
                'footer_logo.image' => 'The footer logo must be an image file.',
                'footer_logo.mimes' => 'The footer logo must be a file of type: png, jpg, jpeg.',
                'footer_logo.max' => 'The footer logo may not be greater than 2 MB.',
                'currency_symbol.required' => 'Currency symbol required',
            ]);

        try {

               // Fetch the existing site setting
            $siteSetting = SiteSetting::findOrFail($site_id);

            // Process the logo image
            $save_url = $request->header_logo_hidden;
            if ($request->file('logo')) {
                // Remove the existing logo
                removeImage($siteSetting->logo);

                $image = $request->file('logo');
                $save_url = processLogoImage($image, 255, 55);
            }

            // Process the side header logo image
            $save_side_url = $request->side_header_logo_hidden;
            if ($request->file('side_header_logo')) {
                  // Remove the existing side header logo
                removeImage($siteSetting->side_header_logo);
                $image = $request->file('side_header_logo');
                $save_side_url = processLogoImage($image, 255, 55);
            }

            // Process the footer logo image
            $save_footer_url = $request->footer_logo_hidden;
            if ($request->file('footer_logo')) {
                 // Remove the existing footer logo
                removeImage($siteSetting->footer_logo);
                $image = $request->file('footer_logo');
                $save_footer_url = processLogoImage($image, 118, 93);
            }

            // Process the footer logo image
            $favicon = $request->hidden_favicon;
            if ($request->file('favicon')) {
                 // Remove the existing footer logo
                removeImage($siteSetting->favicon);
                $image = $request->file('favicon');
                $favicon = processFaviconImage($image, 24, 24);
            }

            // Start a database transaction
            DB::beginTransaction();
            // Update the SiteSetting model
            $siteSetting->update([
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'company_name' => $request->company_name,
                'favicon' => $favicon,
                'open_timming' => $request->open_timming,
                'email' => $request->email,
                'about' => $request->about,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'twitter' => $request->twitter,
                'logo' => $save_url,
                'footer_logo' => $save_footer_url,
                'website'  => $request->website,
                'side_header_logo' => $save_side_url,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'currency_symbol' => $request->currency_symbol,
            ]);

            // Commit the transaction
            DB::commit();
            // Redirect back with success notification
            $notification = [
                'message' => 'SiteSetting Updated with Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();
            // Handle exceptions
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function AllContact()
    {
        try {

            $contact = Contact::orderBy('id', 'DESC')->get();
            return view('backend.contact.contact', compact('contact'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in all contact method.'.$e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method

    public function ContactDetails($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            $contact = Contact::find($id);
           // Attempt to update the status (assuming you have a 'status' column in your 'contacts' table)
            $updateResult = $contact->update(['status' => 'read']);

            if (!$updateResult) {

                $notification = [
                    'message' => 'Failed to update contact status.',
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }

            return view('backend.contact.contact_details', compact('contact'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in contact details method'.$e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method

    public function ContactDetele($encryptedId)
    {

        try {
            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            $category = Contact::findOrFail($id);
            $category->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Contact Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error deleting contact.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method
    public function TermService()
    {
        try {

            $term_service = TermService::find(1);
            return view('backend.setting.term_service',compact('term_service'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in TermService method.'.$e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method
    public function PrivacyPolicy()
    {
        try {

            $privacy_policy = PrivacyPolicy::find('1');
            return view('backend.setting.privacy_policy',compact('privacy_policy'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Privacy Policy method.'.$e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method

    public function UpdateTermService(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'term_service' => 'required|string',
            ], [
                'term_service.required' => 'The Term Service  is required.',
            ]);

            if ($validator->fails()) {

                $notification = [
                    'message' => 'Validation failed : ' . $validator->errors()->first(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

            // Begin a database transaction
            DB::beginTransaction();

            $term_service = $request->id;

            // Database insertion
            TermService::findOrFail($term_service)->update([

                'term_service' => $request->term_service,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            $notification = array(
                'message' => 'Term Service Submit Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception inTerm Service method'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method
    public function UpdatePrivacyPolicy(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'privacy_policy' => 'required|string',
            ], [
                'privacy_policy.required' => 'The Privacy Policy  is required.',
            ]);

            if ($validator->fails()) {

                $notification = [
                    'message' => 'Validation failed : ' . $validator->errors()->first(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

            // Begin a database transaction
            DB::beginTransaction();

            $privacy_policy = $request->id;

            // Database insertion
            PrivacyPolicy::findOrFail($privacy_policy)->update([

                'privacy_policy' => $request->privacy_policy,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            $notification = array(
                'message' => 'Privacy Policy Submit Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Privacy Policy method'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function PackageSetting (){
        try{

            $package = package_plan_setting::all();
        return view('backend.package.setting',compact('package'));

        }catch(\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Privacy Policy method'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function PackageEdit($encryptedId)
    {

        try {

            $id = decrypt($encryptedId);
            $package = package_plan_setting::find($id);
            $package_name = ['Basic','Business','Professional'];

            if (!$package) {

                $notification = [
                    'message' => 'Failed to find id.',
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }

            return view('backend.package.setting_edit', compact('package','package_name'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Package Edit method'.$e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method

    public function UpdatePackage(Request $request)
    {
        try {
             // Validation
        $validator = Validator::make($request->all(), [
            'package_name' => 'required|string|max:255|unique:package_plan_settings,package_name,' . $request->id,
            'package_credits' => 'required|numeric',
            'package_amount' => 'required|numeric',
        ], [
            'privacy_policy.required' => 'The Privacy Policy is required.',
            'package_name.required' => 'The Package Name is required.',
            'package_name.max' => 'The Package Name cannot exceed 255 characters.',
            'package_credits.required' => 'The Package Credits is required.',
            'package_credits.numeric' => 'The Package Credits must be an numeric.',
            'package_amount.required' => 'The Package Amount is required.',
            'package_amount.numeric' => 'The Package Amount must be a number.',

        ]);

        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed: ' . $validator->errors()->first(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }


            // Begin a database transaction
            DB::beginTransaction();

            $package = $request->id;

            // Database insertion
            package_plan_setting::findOrFail($package)->update([

                'package_name' => $request->package_name,
                'package_credits' => $request->package_credits,
                'package_amount' => $request->package_amount,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            $notification = array(
                'message' => 'Submit Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('package.setting')->with($notification);

        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in UpdatePackage method'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function Banner(){
        try{

            $banner = Banner::find(1);
            return view('backend.Banner.banner',compact('banner'));

        }catch(\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in'.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function UpdateBanner(Request $request){

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,|max:2048',
            'heading' => 'required|string|max:255',
            'subheading' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $banner_id = $request->id;
            // Validate the request data with custom messages


        try {

               // Fetch the existing site setting
            $banner = Banner::findOrFail($banner_id);

            // Process the logo image
            $save_url = $request->hidden_banner;
            if ($request->file('banner')) {
                // Remove the existing banner
                removeImage($banner->banner);
                $image = $request->file('banner');
                $save_url = processBannerImage($image, 1920, 760);
            }

            // Start a database transaction
            DB::beginTransaction();
            // Update the banner model
            $banner->update([
                'banner' => $save_url,
                'heading' => $request->heading,
                'subheading' => $request->subheading,

            ]);

            // Commit the transaction
            DB::commit();
            // Redirect back with success notification
            $notification = [
                'message' => 'Updated with Banner Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();
            // Handle exceptions
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

}
