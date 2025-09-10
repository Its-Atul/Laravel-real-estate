<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Facility;
use App\Models\Property;
use App\Models\Schedule;
use App\Models\Amenities;
use App\Models\LocalArea;
use App\Mail\ScheduleMail;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\SiteSetting;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    public function AllProperty()
    {

        try{

            $property = Property::latest()->get();
            return view('backend.property.all_property', compact('property'));

        } catch (\Exception $e) {
            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while loading the Add Property page. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method


    public function AddProperty()
    {
        try {
            // Fetch the latest property types, states, amenities, and active agents
            $propertytype = PropertyType::latest()->get();
            $amenities = Amenities::orderBy('amenitis_name')->get();
            $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();
            // Return the view with the fetched data
            return view('backend.property.add_property', compact('propertytype', 'amenities', 'activeAgent'));
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while loading the Add Property page. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    // End Method

    public function StoreProperty(Request $request)
    {

        // Validation rules
        $validator = Validator::make($request->all(), [
            'property_name' => 'required|string',
            'property_status' => 'required|string',
            'lowest_price' => 'required|numeric',
            'max_price' => 'nullable|numeric',
            'property_thambnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'garage' => 'required|numeric',
            'garage_size' => 'required|numeric',
            'country' => 'required|numeric',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'local_area' => 'required|numeric',
            'address' => 'required|string',
            'postal_code' => 'required|numeric',
            'property_size' => 'required|numeric',
            'property_video' => 'required|url',
            'latitude' => 'required',
            'longitude' => 'required',
            'ptype_id' => 'required|numeric',
            'amenities_id' => 'required|array|min:1',
            'amenities_id.*' => 'numeric',
            'short_descp' => 'required|string|max:500',
            'long_descp' => 'required|string|max:2000',
            'facility_name.*' => 'required|string',
            'distance.*' => 'required|numeric',
        ], [
            'property_name.required' => 'Please enter the Property Name',
            'property_status.required' => 'Please select the Property Status',
            'lowest_price.required' => 'Please enter the Lowest Price',
            'lowest_price.numeric' => 'Please enter a valid number for price',
            'property_thambnail.required' => 'Please choose a Thumbnail Image',
            'property_thambnail.image' => 'The selected file must be an image',
            'property_thambnail.mimes' => 'The image must be of type: jpeg, png, jpg',
            'property_thambnail.max' => 'The image must not exceed 2048 kilobytes',
            'multi_img.*.image' => 'The selected file must be an image',
            'multi_img.*.mimes' => 'The image must be of type: jpeg, png, jpg',
            'multi_img.*.max' => 'The image must not exceed 2048 kilobytes',
            'bedrooms.required' => 'Please enter the Number of Bedrooms',
            'bedrooms.numeric' => 'Please enter a valid number for Bedrooms',
            'bathrooms.required' => 'Please enter the Number of Bathrooms',
            'bathrooms.numeric' => 'Please enter a valid number for Bathrooms',
            'garage.required' => 'Please enter the Number of Garages',
            'garage.numeric' => 'Please enter a valid number for Garages',
            'garage_size.required' => 'Please enter the Garage Size',
            'garage_size.numeric' => 'Please enter a valid number for Garage Size',
            'country.required' => 'Please select the Country',
            'state.required' => 'Please enter the State',
            'city.required' => 'Please enter the City',
            'local_area.required' => 'Please enter the Local Area',
            'address.required' => 'Please enter the Address',
            'postal_code.required' => 'Please enter the Postal Code',
            'postal_code.numeric' => 'Please enter a valid number for Postal Code',
            'property_size.required' => 'Please enter the Property Size',
            'property_size.numeric' => 'Please enter a valid number for Property Size',
            'property_video.required' => 'Please enter the Property Video URL',
            'property_video.url' => 'Please enter a valid URL for Property Video',
            'latitude.required' => 'Please enter the Latitude',
            'longitude.required' => 'Please enter the Longitude',
            'ptype_id.required' => 'Please select the Property Type',
            'amenities_id.required' => 'Please select at least one Amenity',
            'amenities_id.min' => 'Please select at least one Amenity',
            'amenities_id.*.numeric' => 'Please enter valid numbers for Amenities',
            'short_descp.required' => 'Please enter Short Description',
            'short_descp.max' => 'Maximum length is 500 characters for Short Description',
            'long_descp.required' => 'Please enter Long Description',
            'long_descp.max' => 'Maximum length is 2000 characters for Long Description',
            'facility_name.*.required' => 'Please enter Facility Name',
            'distance.*.required' => 'Please enter Distance',
            'distance.*.numeric' => 'Please enter valid numbers for Distance',
        ]);

         // Check for validation errors
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

            $amen = $request->amenities_id;
            $amenites = implode(",", $amen);
            // dd($amenites);

            $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

            if ($request->file('property_thambnail')) {
                $image = $request->file('property_thambnail');
                $save_url = processPropertyImage($image,370, 250);
            }

            $property_id = Property::insertGetId([

                'ptype_id' => $request->ptype_id,
                'amenities_id' => $amenites,
                'property_name' => $request->property_name,
                'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
                'property_code' => $pcode,
                'property_status' => $request->property_status,

                'lowest_price' => $request->lowest_price,
                'max_price' => $request->max_price,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'garage' => $request->garage,
                'garage_size' => $request->garage_size,

                'property_size' => $request->property_size,
                'property_video' => $request->property_video,
                'address' => $request->address,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'local_area_id' => $request->local_area,
                'postal_code' => $request->postal_code,

                'neighborhood' => $request->neighborhood,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'featured' => $request->featured,
                'hot' => $request->hot,
                'agent_id' => $request->agent_id ?? Auth::user()->id,
                'status' => 1,
                'property_thambnail' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            /// Multiple Image Upload From Here ////

            if ($request->file('multi_img')) {
                $images = $request->file('multi_img');
                foreach ($images as $img) {
                    $uploadPath = processMultiPropertyImage($img,770, 520);
                    MultiImage::insert([

                        'property_id' => $property_id,
                        'photo_name' => $uploadPath,
                        'created_at' => Carbon::now(),

                    ]);
                } // End Foreach
            }

            /// End Multiple Image Upload From Here ////

            /// Facilities Add From Here ////

            $facilities = Count($request->facility_name);

            if ($facilities != NULL) {
                for ($i = 0; $i < $facilities; $i++) {
                    $fcount = new Facility();
                    $fcount->property_id = $property_id;
                    $fcount->facility_name = $request->facility_name[$i];
                    $fcount->distance = $request->distance[$i];
                    $fcount->save();
                }
            }

            /// End Facilities  ////

            // Commit the transaction if all operations are successful
            DB::commit();

            $notification = array(
                'message' => 'Property Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.property')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while storing the property. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function EditProperty($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            // Attempt to find the property by ID
            $property = Property::findOrFail($id);

            // Extract amenities information
            $type = $property->amenities_id;
            $property_ami = explode(',', $type);

            // Fetch facilities associated with the property
            $facilities = Facility::where('property_id', $id)->get();

            // Fetch multi-images associated with the property
            $multiImage = MultiImage::where('property_id', $id)->get();

            // Fetch all states for dropdown
            $pstate = State::latest()->get();

            // Fetch property types for dropdown
            $propertytype = PropertyType::latest()->get();

            // Fetch all amenities for dropdown
            $amenities = Amenities::orderBy('amenitis_name')->get();

            // Fetch active agents for dropdown
            $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();

            // Fetch all countries for dropdown
            $country = Country::orderBy('name', 'ASC')->get();
            $country_id = $property->country_id;

            // Fetch states based on the country of the property
            $states = State::where('country_id', $country_id)->orderBy('state_name', 'ASC')->get();
            $state_id = $property->state_id;

            // Fetch cities based on the state of the property
            $cities = City::where('state_id', $state_id)->orderBy('name', 'ASC')->get();
            $city_id = $property->city_id;

            // Fetch local areas based on the city of the property
            $localAreas = LocalArea::where('city_id', $city_id)->orderBy('name', 'ASC')->get();

            // Return the view with property and related data
            return view('backend.property.edit_property', compact('property', 'country', 'cities', 'states', 'localAreas', 'propertytype', 'amenities', 'activeAgent', 'property_ami', 'multiImage', 'facilities', 'pstate'));

        } catch (\Exception $e) {
            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while fetching property details for editing. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method
    public function UpdateProperty(Request $request)
    {

         // Validation rules
         $validator = Validator::make($request->all(), [
            'ptype_id' => 'required',
            'amenities_id' => 'required|array',
            'property_name' => 'required|string',
            'property_status' => 'required|in:rent,buy',
            'lowest_price' => 'required|numeric',
            'max_price' => 'nullable|numeric',
            'short_descp' => 'required|string',
            'long_descp' => 'required|string',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'garage' => 'required|numeric',
            'garage_size' => 'required|numeric',
            'property_size' => 'required|numeric',
            'property_video' => 'required|url',
            'address' => 'required|string',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'local_area' => 'required',
            'postal_code' => 'required|string',
            'neighborhood' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'featured' => 'nullable|boolean',
            'hot' => 'nullable|boolean',
            'agent_id' => 'nullable',
        ], [
            'ptype_id.required' => 'The property type is required.',
            'amenities_id.required' => 'At least one amenity is required.',
            'property_name.required' => 'The property name is required.',
            'property_status.required' => 'Please choose a property status.',
            'lowest_price.required' => 'The lowest price is required.',
            'lowest_price.numeric' => 'Invalid lowest price format.',
            'max_price.numeric' => 'The max price must be a number.',
            'short_descp.required' => 'The short description is required.',
            'long_descp.required' => 'The long description is required.',
            'bedrooms.required' => 'The number of bedrooms is required.',
            'bedrooms.numeric' => 'The number of bedrooms must be a number.',
            'bathrooms.required' => 'The number of bathrooms is required.',
            'bathrooms.numeric' => 'The number of bathrooms must be a number.',
            'garage.required' => 'The garage information is required.',
            'garage.numeric' => 'The garage must be a number.',
            'garage_size.required' => 'The garage size is required.',
            'garage_size.numeric' => 'The garage size must be a number.',
            'property_size.required' => 'The property size is required.',
            'property_size.numeric' => 'The property size must be a number.',
            'property_video.required' => 'The property video URL is required.',
            'property_video.url' => 'Invalid property video URL format.',
            'address.required' => 'The address is required.',
            'country.required' => 'Please select a country.',
            'state.required' => 'Please select a state.',
            'city.required' => 'Please select a city.',
            'local_area.required' => 'Please select a local area.',
            'postal_code.required' => 'The postal code is required.',
            'neighborhood.string' => 'The neighborhood must be a string.',
            'latitude.required' => 'The latitude is required.',
            'latitude.numeric' => 'The latitude must be a number.',
            'longitude.required' => 'The longitude is required.',
            'longitude.numeric' => 'The longitude must be a number.',
            'featured.boolean' => 'The featured field must be a boolean.',
            'hot.boolean' => 'The hot field must be a boolean.',
            'agent_id.nullable' => 'Invalid agent ID format.',
        ]);

        // Check for validation errors
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

            $amen = $request->amenities_id;
            $amenites = implode(",", $amen);

            $property_id = $request->id;

            Property::findOrFail($property_id)->update([

                'ptype_id' => $request->ptype_id,
                'amenities_id' => $amenites,
                'property_name' => $request->property_name,
                'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
                'property_status' => $request->property_status,

                'lowest_price' => $request->lowest_price,
                'max_price' => $request->max_price,
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'garage' => $request->garage,
                'garage_size' => $request->garage_size,

                'property_size' => $request->property_size,
                'property_video' => $request->property_video,
                'address' => $request->address,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'local_area_id' => $request->local_area,
                'postal_code' => $request->postal_code,

                'neighborhood' => $request->neighborhood,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'featured' => $request->featured,
                'hot' => $request->hot,
                'agent_id' => $request->agent_id ?? Auth::user()->id,
                'updated_at' => Carbon::now(),

            ]);

            // Commit the transaction if the update is successful
            DB::commit();

            $notification = array(
                'message' => 'Property Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.property')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while updating the property. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function UpdatePropertyThambnail(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:properties,id',
            'property_thambnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'old_img' => 'required',
        ], [
            'property_thambnail.required' => 'Please choose an image for the thumbnail.',
            'property_thambnail.image' => 'The selected file must be an image.',
            'property_thambnail.mimes' => 'Invalid image format. Only JPEG, PNG, JPG formats are allowed.',
            'property_thambnail.max' => 'The image size must not exceed 2MB.',
            'old_img.required' => 'The old image path is required.',
            'id.exists' => 'Invalid property ID.',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed: ' . $validator->errors()->first(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            $pro_id = $request->id;
            $oldImage = $request->old_img;

            if ($request->file('property_thambnail')) {
                $image = $request->file('property_thambnail');
                $save_url = processPropertyImage($image,370, 250);
            }
            // Check if the old image file exists before attempting to unlink it
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            // Attempt to update the property thumbnail and update timestamp
            Property::findOrFail($pro_id)->update([
                'property_thambnail' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            // Commit the transaction if the update is successful
            DB::commit();

            $notification = [
                'message' => 'Property Image Thumbnail Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while updating the property thumbnail. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method

    public function UpdatePropertyMultiimage(Request $request)
    {

        // Define custom error messages
        $customMessages = [
            'multi_img.required' => 'The image field is required.',
            //'multi_img.image' => 'The file must be an image.',
            //'multi_img.mimes' => 'The image must be a file of type: jpeg, png, jpg',
            //'multi_img.max' => 'The image may not be greater than 2048 kilobytes.',
        ];

        // Validate the request with custom messages
        $validator = Validator::make($request->all(), [
            'multi_img' => 'required',
           //'multi_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], $customMessages);

        // Check if validation fails
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
            $imgs = $request->multi_img;

            foreach ($imgs as $id => $img) {
                $imgDel = MultiImage::findOrFail($id);
                unlink($imgDel->photo_name);
                $uploadPath = processMultiPropertyImage($img,770, 520);
                // $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                // $manager = new ImageManager(new Driver());
                // $image = $manager->read($img)->resize(770, 520);
                // // Save the manipulated image
                // $image->toJpeg()->save('upload/property/multi-image/' . $make_name);

                // $uploadPath = 'upload/property/multi-image/' . $make_name;

                MultiImage::where('id', $id)->update([

                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),

                ]);
            } // End Foreach

            // Commit the transaction if all updates are successful
            DB::commit();

            $notification = array(
                'message' => 'Property Multi Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while updating property multi-images. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function PropertyMultiImageDelete($id)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Fetch the old image data
            $oldImg = MultiImage::findOrFail($id);

            // Delete the image file from the storage
            unlink($oldImg->photo_name);

            // Delete the record from the database
            MultiImage::findOrFail($id)->delete();

            // Commit the transaction if deletion is successful
            DB::commit();

            $notification = [
                'message' => 'Property Multi Image Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while deleting the property multi-image. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method
    public function StoreNewMultiimage(Request $request)
    {
        try {
            // Define custom error messages
            $customMessages = [
                'imageid.required' => 'The image ID field is required.',
                'imageid.numeric' => 'The image ID must be a number.',
                'multi_img.required' => 'The multi image field is required.',
                'multi_img.image' => 'The multi image must be an image.',
                'multi_img.mimes' => 'The multi image must be a file of type: jpeg, png, jpg',
                'multi_img.max' => 'The multi image may not be greater than 2048 kilobytes.',
            ];

            // Validate the incoming request data with custom messages
            $validator = Validator::make($request->all(), [
                'imageid' => 'required|numeric',
                'multi_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ], $customMessages);

            // Check if validation fails
            if ($validator->fails()) {
                $notification = [
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }

            // Start a database transaction
            DB::beginTransaction();

            try {

                $new_multi = $request->imageid;
                if ($request->file('multi_img')) {
                    $image = $request->file('multi_img');
                    $uploadPath = processMultiPropertyImage($image,770, 520);
                }

                MultiImage::insert([
                    'property_id' => $new_multi,
                    'photo_name' => $uploadPath,
                    'created_at' => now(),
                ]);

                // Commit the transaction if the operations are successful
                DB::commit();

                $notification = [
                    'message' => 'Property Multi Image Added Successfully',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
            } catch (\Exception $e) {
                // Rollback the transaction in case of an exception
                DB::rollback();

                // Log the exception or handle it in a way that suits your application
                $notification = [
                    'message' => 'An error occurred while adding property multi image. ' . $e->getMessage(),
                    'alert-type' => 'error',
                ];

                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            $notification = [
                'message' => 'An error occurred. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    // End Method
    public function UpdatePropertyFacilities(Request $request)
    {
        // Define custom error messages
        $customMessages = [
            'id.required' => 'The property ID field is required.',
            'id.numeric' => 'The property ID must be a number.',
            'facility_name.required' => 'At least one facility name is required.',
            'facility_name.array' => 'The facility name must be an array.',
            'facility_name.*.required' => 'Each facility name is required.',
            'facility_name.*.string' => 'Each facility name must be a string.',
            'distance.required' => 'At least one distance is required.',
            'distance.array' => 'The distance must be an array.',
            'distance.*.required' => 'Each distance is required.',
            'distance.*.numeric' => 'Each distance must be a number.',
        ];

        // Validate the incoming request data with custom messages
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'facility_name' => 'required|array',
            'facility_name.*' => 'required|string',
            'distance' => 'required|array',
            'distance.*' => 'required|numeric',
        ], $customMessages);

        // Check if validation fails
        if ($validator->fails()) {
            $notification = [
                'message' => 'Validation failed: ' . $validator->errors()->first(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            $pid = $request->id;

            if ($request->facility_name == NULL) {
                return redirect()->back();
            } else {
                // Delete existing facilities for the property
                Facility::where('property_id', $pid)->delete();

                $facilities = count($request->facility_name);

                for ($i = 0; $i < $facilities; $i++) {
                    $fcount = new Facility();
                    $fcount->property_id = $pid;
                    $fcount->facility_name = $request->facility_name[$i];
                    $fcount->distance = $request->distance[$i];
                    $fcount->save();
                } // end for
            }

            // Commit the transaction if all operations are successful
            DB::commit();

            $notification = [
                'message' => 'Property Facility Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while updating property facilities. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method

    public function DeleteProperty($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            // Attempt to find the property by ID
            $property = Property::findOrFail($id);

            // Delete the property thumbnail file
            unlink($property->property_thumbnail);

            // Delete the property record
            $property->delete();

            // Delete associated multi images
            $images = MultiImage::where('property_id', $id)->get();
            foreach ($images as $img) {
                unlink($img->photo_name);
                $img->delete();
            }

            // Delete associated facilities
            $facilitiesData = Facility::where('property_id', $id)->get();
            foreach ($facilitiesData as $item) {

                $item->delete();
            }

            // Commit the transaction if all operations are successful
            DB::commit();

            $notification = [
                'message' => 'Property Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while deleting the property. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method


    public function DetailsProperty($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            // Attempt to find the property by ID
            $property = Property::findOrFail($id);

            // Extract amenities information
            $type = $property->amenities_id;
            $property_ami = explode(',', $type);

            // Fetch the amenities based on IDs
            $amenities = Amenities::whereIn('id', $property_ami)->get();

            // Return the view with property and amenities data
            return view('backend.property.details_property', compact('property', 'amenities'));

        } catch (\Exception $e) {
            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while fetching property details. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method
    public function InactiveProperty(Request $request)
    {

        try {

            $pid = $request->id;

            // Start a database transaction
             DB::beginTransaction();

            // Attempt to update the property status
            Property::findOrFail($pid)->update([

                'status' => 0,

            ]);

             // Commit the transaction if the update is successful
             DB::commit();

            $notification = array(
                'message' => 'Property Inactive Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.property')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while activating the property. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function ActiveProperty(Request $request)
    {
        try {

            $pid = $request->id;

            // Start a database transaction
            DB::beginTransaction();

            // Attempt to update the property status
            Property::findOrFail($pid)->update([
                'status' => 1,
            ]);

            // Commit the transaction if the update is successful
            DB::commit();

            $notification = [
                'message' => 'Property Active Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.property')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            // Log the exception or handle it in a way that suits your application
            $notification = [
                'message' => 'An error occurred while activating the property. ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method

    public function AdminPackageHistory()
    {

        try {

            $currency_symbol = SiteSetting::find(1);
            $currency = $currency_symbol->currency_symbol;
            $packagehistory = PackagePlan::orderBy('id','DESC')->get();
            return view('backend.package.package_history', compact('packagehistory','currency'));

        } catch (\Exception $e) {
            // Log the exception or handle it in a way that suits your application
            $notification = array(
                'message' => 'An error occurred while fetching package history.'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function PackageInvoice($id)
    {
        try {

            $packagehistory = PackagePlan::where('package_plans.id', $id)->first();
            $uId = $packagehistory->user_id;
            $currency_symbol = SiteSetting::find(1);
            $currency = $currency_symbol->currency_symbol;
            $sitesetting = SiteSetting::find(1);
            $data = User::where('users.id',$uId)->first();
            // Check if the package history is not found
            if (!$packagehistory) {
                abort(404);
            }
             // Check if the sitesetting is not found
             if (!$sitesetting) {
                abort(404);
            }
             // Check if the data is not found
             if (!$data) {
                abort(404);
            }
            //return view('backend.package.package_history_invoice', compact('currency','packagehistory','sitesetting','data'));

            $pdf = Pdf::loadView('backend.package.package_history_invoice', compact('currency','packagehistory','sitesetting','data'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);

            return $pdf->download('invoice.pdf');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during PDF generation
            $notification = array(
                'message' => 'An error occurred while generating the PDF.'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminPropertyMessage()
    {
        try {

            $usermsg = PropertyMessage::orderBy('id', 'DESC')->get();
            return view('backend.message.all_message', compact('usermsg'));

        } catch (\Exception $e) {
            // Log or handle the exception as needed
            $notification = array(
                'message' => 'An error occurred while retrieving property messages.'.$e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminMessageDetails($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            $msgdetails = PropertyMessage::findOrFail($id);
            // Attempt to update the status (assuming you have a 'status' column in your 'contacts' table)
            $updateMsg = $msgdetails->update(['admin_status' => 'read']);

            if (!$updateMsg) {

                $notification = [
                    'message' => 'Failed to update msg status.',
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }

            return view('backend.message.message_details', compact('msgdetails'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in msg details method'.$e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);

        }
    } // End Method

    public function AdminMessageDetele($encryptedId)
    {

        try {
            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            $message = PropertyMessage::findOrFail($id);
            $message->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Message Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error deleting message.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminScheduleRequest()
    {
        try {

            $usermsg = Schedule::orderBy('id', 'desc')->get();
            return view('backend.schedule.schedule_request', compact('usermsg'));
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error AdminScheduleRequest message.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method
    public function AdminDetailsSchedule($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            $schedule = Schedule::findOrFail($id);
            return view('backend.schedule.schedule_details', compact('schedule'));
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error AdminDetailsSchedule message.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminUpdateSchedule(Request $request)
    {
        try {

            $sid = $request->id;
            $schedule = Schedule::findOrFail($sid);

            // Start Send Email
            $data = [
                'tour_date' => $schedule->tour_date,
                'tour_time' => $schedule->tour_time,
            ];


           $sendmail = Mail::to($request->email)->send(new ScheduleMail($data));

           if($sendmail){
            $schedule->update(['status' => '1',]);
            $notification = [
                'message' => 'You have Confirm Schedule Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('admin.schedule.request')->with($notification);
           }


        } catch (\Exception $e) {
            // Log the exception or handle it appropriately (e.g., return an error response)
            $notification = [
                'message' => 'An error occurred while updating the schedule.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->route('agent.schedule.request')->with($notification);
        }

    } // End Method

    public function AdminDeteleSchedule($encryptedId)
    {

        try {
            $id = decrypt($encryptedId);

            // Start a database transaction
            DB::beginTransaction();

            $schedule = Schedule::findOrFail($id);
            $schedule->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Schedule Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error deleting message.'.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

}
