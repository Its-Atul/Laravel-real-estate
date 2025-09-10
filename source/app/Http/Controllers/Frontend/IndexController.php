<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\Contact;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Schedule;
use App\Mail\ContactMail;
use App\Models\Amenities;
use App\Models\MultiImage;
use App\Models\SiteSetting;
use App\Models\TermService;
use App\Models\Testimonial;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\PropertyMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function PropertyDetails($encryptedId, $slug)
    {

        try {


            // Check if $encryptedId is numeric
            if (is_numeric($encryptedId)) {
                // If $encryptedId is numeric, assume it's already decrypted
                $id = $encryptedId;
            } else {
                // If $encryptedId is not numeric, decrypt it
                $id = decrypt($encryptedId);
            }

            // Share component for social media sharing
            $shareComponent = \Share::currentPage()
                ->facebook('Check out this awesome property details!')
                ->twitter('Check out this awesome property details!')
                ->linkedin('Check out this awesome property details!')
                ->whatsapp('Check out this awesome property details!')
                ->telegram('Check out this awesome property details!');

            // Find the property by ID
            $property = Property::findOrFail($id);

            // Set the page title to the property name or an empty string if not available
            $page_title = $property->property_name ?? '';

            // Extract amenities information
            $amenities = $property->amenities_id;
            $type = $property->amenities_id;
            $property_ami = explode(',', $type);
            $property_amen = Amenities::whereIn('id', $property_ami)->get();

            // Retrieve multi images for the property
            $multiImage = MultiImage::where('property_id', $id)->get();

            // Retrieve facilities for the property
            $facility = Facility::where('property_id', $id)->get();

            // Get the property type ID
            $type_id = $property->ptype_id;

            $currency_symbol = SiteSetting::find(1);

            // Retrieve featured properties
            $featured = Property::where('featured', '1')->where('status','1')->latest()->limit(3)->get();

            // Retrieve related properties based on type and exclude the current property
            $relatedProperty = Property::where('ptype_id', $type_id)
                ->where('id', '!=', $id)
                ->where('status', '=', '1')
                ->orderBy('id', 'DESC')
                ->limit(3)
                ->get();

            // Return the property details view with necessary data
            return view('frontend.property.property_details', compact('currency_symbol','featured', 'property', 'multiImage', 'property_amen', 'facility', 'relatedProperty', 'page_title', 'shareComponent'));

        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving PropertyDetails information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    } // End Method

    public function PropertyMessage(Request $request)
    {

        try{
             // Validation rules
            $rules = [
                'property_id' => 'nullable|numeric',
                'agent_id' => 'nullable|numeric',
                'msg_name' => 'required',
                'msg_email' => 'required|email',
                'msg_phone' => 'required|numeric|digits:10', // Assuming you want exactly 10 digits for the phone number
                'message' => 'required',
            ];

            // Custom error messages
            $messages = [
                'property_id.numeric' => 'Property ID must be a number.',
                'agent_id.numeric' => 'Agent ID must be a number.',
                'msg_name.required' => 'Name is required.',
                'msg_email.required' => 'Email is required.',
                'msg_email.email' => 'Please enter a valid email address.',
                'msg_phone.required' => 'Phone number is required.',
                'msg_phone.numeric' => 'Phone number must be numeric.',
                'msg_phone.digits' => 'Phone number must be exactly 10 digits.',
                'message.required' => 'Message is required.',
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules, $messages);

            // Check if the validation fails
            if ($validator->fails()) {
                // Redirect back with validation errors
                $notification = [
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

            $pid = $request->property_id;
            $aid = $request->agent_id;

            // Start a database transaction
            DB::beginTransaction();

            if (Auth::check() && Auth::user()->role === 'user') {
                PropertyMessage::insert([
                    'user_id' => Auth::user()->id,
                    'agent_id' => $aid,
                    'property_id' => $pid,
                    'msg_name' => $request->msg_name,
                    'msg_email' => $request->msg_email,
                    'msg_phone' => $request->msg_phone,
                    'message' => $request->message,
                    'created_at' => Carbon::now(),
                ]);

            // Commit the transaction
            DB::commit();

                $notification = array(
                    'message' => 'Send Message Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            } else {

                $notification = array(
                    'message' => 'Login Your User Account First',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {

            DB::rollBack();

                    // Log the exception or handle it as needed

                    // Notification message in case of an error
                    $notification = [
                        'message' => 'Error retrieving PropertyMessage information. '. $e->getMessage(),
                        'alert-type' => 'error',
                    ];

                    // Redirect back with the error notification
                    return redirect()->back()->with($notification);
        }
    } // End Method

    public function AgentDetails($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            // Set the page title
            $page_title = 'Agency Details';

            // Find the agent by ID
            $agent = User::findOrFail($id);

            // Get properties associated with the agent
            $property = Property::where('agent_id', $id)->where('status','1')->get();

            // Get featured properties (limit to 5)
            $featured = Property::where('featured', '1')->latest()->limit(5)->get();

            // Get rental properties
            $rentproperty = Property::where('property_status', 'rent')->get();

            // Get properties available for purchase
            $buyproperty = Property::where('property_status', 'buy')->get();

            $currency_symbol = SiteSetting::find(1);
            // Return the view with the retrieved data
            return view('frontend.agent.agent_details', compact('currency_symbol','agent', 'page_title', 'property', 'featured', 'rentproperty', 'buyproperty'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Error notification message
            $notification = [
                'message' => 'Error retrieving AgentDetails information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    } // End Method


    public function RentProperty()
    {
        try{
            // Set the page title
            $page_title = 'Rent Property';
             // Get properties for rent
             $rentproperty = Property::where('property_status', 'rent')->where('status','1')->get();

             // Get properties for sale
             $buyproperty = Property::where('property_status', 'buy')->where('status','1')->get();

             // Get all amenity
             $amenity = Amenities::orderBy('amenitis_name')->get();

            // Retrieve properties available for rent with pagination
            $property = Property::where('status', '1')->where('property_status', 'rent')->paginate(5);

            $currency_symbol = SiteSetting::find(1);
            // Render the view with the fetched property data and page title
            return view('frontend.property.rent_property', compact('currency_symbol','amenity','buyproperty','rentproperty','property', 'page_title'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving RentProperty information. '. $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    } // End Method
    public function BuyProperty()
    {
        try{
            // Set the page title
            $page_title = 'Buy Property';
             // Get properties for rent
             $rentproperty = Property::where('property_status', 'rent')->where('status','1')->get();

             // Get properties for sale
             $buyproperty = Property::where('property_status', 'buy')->where('status','1')->get();

             // Get all amenity
             $amenity = Amenities::orderBy('amenitis_name')->get();

            // Retrieve active properties with a property status of 'buy' and paginate the results
            $property = Property::where('status', '1')->where('property_status', 'buy')->paginate(5);

            $currency_symbol = SiteSetting::find(1);
            // Render the view with the fetched property data and page title
            return view('frontend.property.buy_property', compact('currency_symbol','property', 'page_title'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving BuyProperty information. '. $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    } // End Method

    public function PropertyType($encryptedId)
    {
        try{

            $id = decrypt($encryptedId);
            $currency_symbol = SiteSetting::find(1);
            // Retrieve properties with the specified property type ID, with status '1', and paginate the results
            $property = Property::where('status', '1')->where('ptype_id', $id)->orderBy('id','DESC')->paginate(10);

            // Retrieve the specific property type for breadcrumb and page title
            $pbread = PropertyType::where('id', $id)->first();

             // Get properties for rent
             $rentproperty = Property::where('property_status', 'rent')->where('status','1')->get();

             // Get properties for sale
             $buyproperty = Property::where('property_status', 'buy')->where('status','1')->get();

             // Get all amenity
             $amenity = Amenities::orderBy('amenitis_name')->get();

            // Set the page title based on the property type
            $page_title = $pbread->type_name;

            // Render the view with the retrieved data
            return view('frontend.property.property_type', compact('currency_symbol','amenity','buyproperty','rentproperty','property', 'pbread','page_title'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving PropertyType information. '. $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    } // End Method

    public function StateDetails($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            // Fetch properties with status '1' (active) for the specified state and paginate the results
            $property = Property::where('status', '1')->where('state_id', $id)->paginate(10);

            // Fetch details of the specified state
            $bstate = State::where('id', $id)->first();

            $currency_symbol = SiteSetting::find(1);

            // Set the page title to the name of the specified state
            $page_title = $bstate->state_name;

            // Fetch properties for rent
            $rentproperty = Property::where('property_status', 'rent')->where('status','1')->get();

            // Fetch properties for sale
            $buyproperty = Property::where('property_status', 'buy')->where('status','1')->get();

            // Render the view with the fetched data
            return view('frontend.property.state_property', compact('currency_symbol','property', 'bstate', 'page_title', 'rentproperty', 'buyproperty'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving State Details information. '. $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    } // End Method

    public function StoreSchedule(Request $request){
        try {
            // Validation rules
            $rules = [
                'agent_id' => 'required|numeric',
                'property_id' => 'required|numeric',
                'tour_date' => 'required|date',
                'time' => 'required',
                'message' => 'required',
            ];

            // Custom error messages
            $messages = [
                'agent_id.required' => 'Agent ID is required.',
                'agent_id.numeric' => 'Agent ID must be a number.',
                'property_id.required' => 'Property ID is required.',
                'property_id.numeric' => 'Property ID must be a number.',
                'tour_date.required' => 'Tour date is required.',
                'tour_date.date' => 'Invalid tour date format.',
                'time.required' => 'Tour time is required.',
                'message.required' => 'Message is required.',
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules, $messages);

            // Check if the validation fails
            if ($validator->fails()) {
                // Redirect back with validation errors
                $notification = [
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }

            // Continue with the insertion logic if validation passes

            $aid = $request->agent_id;
            $pid = $request->property_id;

        // Start a database transaction
        DB::beginTransaction();

            if (Auth::check() && Auth::user()->role === 'user') {
                // Insert the schedule into the database
                Schedule::insert([
                    'user_id' => Auth::user()->id,
                    'property_id' => $pid,
                    'agent_id' => $aid,
                    'tour_date' => $request->tour_date,
                    'tour_time' => $request->time,
                    'message' => $request->message,
                    'created_at' => now(),
                ]);

              // Commit the transaction
              DB::commit();

                // Success notification
                $notification = [
                    'message' => 'Send Request Successfully',
                    'alert-type' => 'success'
                ];

                // Redirect back with the success notification
                return redirect()->back()->with($notification);
            } else {
                // Error notification for unauthorized access
                $notification = [
                    'message' => 'Login Your User Account First',
                    'alert-type' => 'error'
                ];

                // Redirect back with the error notification
                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {

            // Rollback the transaction in case of an error
            DB::rollBack();

            // Notification message in case of an error
            $notification = [
                'message' => 'Error storing schedule. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }// End Method

    public function AllPropertyType(){

        try {
            // Set the page title
            $page_title = 'Categories';

            // Fetch all property types from the database
            $all_Property_type = PropertyType::all();
            $currency_symbol = SiteSetting::find(1);

            // Render the view with the fetched data and page title
            return view('frontend.property.all_property_type', compact('all_Property_type', 'page_title','currency_symbol'));

        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving All Property type information. '. $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }//End Method

    public function AllPropertyListing(Request $request)
    {
        try {

            // Retrieve all the input values from the form
            $propertyName = $request->input('propertyName');
            $propertyCategory = $request->input('propertyCategory');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $localArea = $request->input('local_area');
            $bedrooms = $request->input('bedrooms');
            $bathrooms = $request->input('bathrooms');
            $agents = $request->input('Agents');
            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price');
            $minArea = $request->input('min_area');
            $maxArea = $request->input('max_area');


            // Set the page title
            $page_title = 'Property List';

            // Get all properties with status 1
            $propertyQuery = Property::where('status', '1');

            $propertyQuery->where(function ($query) use ($propertyName, $propertyCategory, $country, $state, $city, $localArea, $bedrooms, $bathrooms, $agents, $minPrice, $maxPrice, $minArea, $maxArea) {
                $query->where('property_name', 'like', "%$propertyName%")
                    ->orWhere('ptype_id', $propertyCategory)
                    ->orWhere('country_id', $country)
                    ->orWhere('state_id', $state)
                    ->orWhere('city_id', $city)
                    ->orWhere('local_area_id', $localArea)
                    ->orWhere('bedrooms', $bedrooms)
                    ->orWhere('bathrooms', $bathrooms)
                    ->orWhere('agent_id', $agents)
                    ->orWhereBetween('lowest_price', [$minPrice, $maxPrice])
                    ->orWhereBetween('property_size', [$minArea, $maxArea]);
            });

            $properties = $propertyQuery->latest()->paginate(10);


            // Filter by price range if provided in the request
            if ($request->filled('min_price') && $request->filled('max_price')) {
                $minPrice = $request->input('min_price');
                $maxPrice = $request->input('max_price');
                $propertyQuery->whereBetween('lowest_price', [$minPrice, $maxPrice]);
            }

            // Filter by area range if provided in the request
            if ($request->filled('min_area') && $request->filled('max_area')) {
                $minarea = $request->input('min_area');
                $maxarea = $request->input('max_area');
                $propertyQuery->whereBetween('property_size', [$minarea, $maxarea]);
            }
            // Filter by country, state, city, local area, property category, and property type if provided in the request
            if ($request->filled('country_id')) {
                $propertyQuery->where('country_id', $request->input('country_id'));
            }
            if ($request->filled('state_id')) {
                $propertyQuery->where('state_id', $request->input('state_id'));
            }
            if ($request->filled('city_id')) {
                $propertyQuery->where('city_id', $request->input('city_id'));
            }
            if ($request->filled('local_area_id')) {
                $propertyQuery->where('local_area_id', $request->input('local_area_id'));
            }
            if ($request->filled('propertyCategory')) {
                $propertyQuery->where('ptype_id', $request->input('propertyCategory'));
            }
            if ($request->filled('propertyType')) {
                $propertyQuery->where('property_status', $request->input('propertyType'));
            }

            $currency_symbol = SiteSetting::find(1);

            // Order properties by ID in descending order and paginate by 10
            $property = $propertyQuery->latest()->paginate(10);

            // Return the view with the property data
            return view('frontend.property.all_property_listing', compact('currency_symbol','property', 'page_title'));

        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving All Property Listing information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }

    public function AboutUs()
    {
        try {
            // Set the page title
            $page_title = 'About Us';

            // Retrieve all testimonials
            $tesimonials = Testimonial::all();

            // Retrieve up to 5 active agents
            $agents = User::where('status', 'active')->where('role', 'agent')->limit(3)->get();

            // Return the view with the necessary data
            return view('frontend.home.about', compact('page_title', 'tesimonials', 'agents'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error About Us information. ' .$e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }//End Method


    public function AgentList(Request $request)
    {
        try {

            $agentName = $request->input('name');

            $query = User::where('status','active')->where('role', 'agent');

            if ($agentName) {
                $query->where('name', 'LIKE', '%'.$agentName.'%');
            }

            // Page title for the view
            $page_title = 'Agents List';

            $currency_symbol = SiteSetting::find(1);

            // Get properties for rent and buy
            $rentproperty = Property::where('property_status', 'rent')->where('status','1')->get();
            $buyproperty = Property::where('property_status', 'buy')->where('status','1')->get();

            // Get featured properties
            $featured = Property::where('featured', '1')->where('status','1')->latest()->limit(3)->get();

            // Get active agents with role 'agent' and paginate the result
            $agents = $query->paginate(5);

            // Return the view with the necessary data
            return view('frontend.agent.agent_list', compact('currency_symbol','page_title', 'agents', 'buyproperty', 'rentproperty', 'featured'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error Contact Us information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }//End Method


    public function ContactUs()
    {
        try {
            // Set the page title
            $page_title = 'Contact Us';

            // Fetch site settings from the database
            $sitesetting = SiteSetting::find(1);

            // Pass data to the contact view
            return view('frontend.home.contact', compact('page_title', 'sitesetting'));
        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Set a notification message for the user
            $notification = [
                'message' => 'Error retrieving Contact Us information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the notification
            return redirect()->back()->with($notification);
        }
    }// End Method

    public function ContactStore(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:250',
            'email' => 'required|email|max:250',
            'phone' => 'required|digits:10',
            'subject' => 'required|string|max:250',
            'message' => 'required|string|max:500',
        ], [
            // Custom validation messages
            'username.required' => 'Please enter your username.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
            'subject.required' => 'Please enter the subject.',
            'message.required' => 'Please enter your message.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed: ' . $validator->errors()->first(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        try {
            // Retrieve site settings
            $site = SiteSetting::find(1);

            // Begin a database transaction
            DB::beginTransaction();

            // Database insertion
            $con_data = [
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            // Create a new contact record
            Contact::create($con_data);

            // Send email notification
            Mail::to($site['email'])->send(new ContactMail($con_data));

            // Commit the transaction if everything is successful
            DB::commit();

            // Notify the user of successful submission
            $notification = [
                'message' => 'Contact information submitted successfully.',
                'alert-type' => 'success',
            ];

            return redirect()->route('contact.us')->with($notification);

        } catch (\Exception $e) {
            // Log the exception
            Log::error($e);

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Notify the user of the error
            $notification = [
                'message' => 'Error storing contact information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function PrivacyPolicy(){

        try {
            // Set the page title
            $page_title = 'Privacy Policy';

            // Retrieve privacy policy information from the database
            $privacy_policy = PrivacyPolicy::find(1);

            // Pass the data to the view and render it
            return view('frontend.home.privacy_policy', compact('page_title', 'privacy_policy'));

        } catch (\Exception $e) {
            // An exception occurred

            // In this example, a notification is created for the user
            $notification = [
                'message' => 'Error retrieving privacy policy information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the notification
            return redirect()->back()->with($notification);
        }

    }//End Method

    public function TermService()
    {
        try {
            // Set the page title
            $page_title = 'Term of Service';

            // Retrieve TermService information from the database
            $term_service = TermService::find(1);

            // Return the view with page title and term service data
            return view('frontend.home.term_service', compact('page_title', 'term_service'));
        } catch (\Exception $e) {
            // Handle exceptions and log them if necessary

            // Create a notification message for the error
            $notification = [
                'message' => 'Error retrieving term service information. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the notification message
            return redirect()->back()->with($notification);
        }
    }// End Method

    public function InactiveAccount()
    {
        try {
            return view('errors.inactive_account');

        } catch (\Exception $e) {
            // Redirect back with the notification message
            return response(['error => $e->getMessage()']);
        }
    }// End Method

    public function amenityProperty($encryptedId)
    {
        try{

            $id = decrypt($encryptedId);
            // Get properties for rent
            $rentproperty = Property::where('property_status', 'rent')->where('status', '1')->get();

            // Get properties for sale
            $buyproperty = Property::where('property_status', 'buy')->where('status', '1')->get();

            $currency_symbol = SiteSetting::find(1);
            // Get all amenity
            $amenity = Amenities::orderBy('amenitis_name')->get();

            // Retrieve properties with the specified property type ID, with status '1', and paginate the results
            $property = Property::where('status', '1')->whereRaw("FIND_IN_SET(?, amenities_id)", [$id])->latest()->paginate(10);

            // Retrieve the specific property type for breadcrumb and page title
            $amenityName = Amenities::where('id', $id)->first();

            // Set the page title based on the property type
            $page_title = $amenityName->amenitis_name;

            // Render the view with the retrieved data
            return view('frontend.property.amenity', compact('currency_symbol','amenity','buyproperty','rentproperty','property','page_title'));

        } catch (\Exception $e) {
            // Log the exception or handle it as needed

            // Notification message in case of an error
            $notification = [
                'message' => 'Error retrieving Amenity Property information. '. $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }

    public function currencySymbol()
    {
        try {

            $currency_symbol = SiteSetting::findOrFail(1)->currency_symbol;
            return response()->json(['currency_symbol' => $currency_symbol]);

        } catch (\Exception $e) {
            // Notification message in case of an error
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            // Redirect back with the error notification
            return redirect()->back()->with($notification);
        }
    }



}
