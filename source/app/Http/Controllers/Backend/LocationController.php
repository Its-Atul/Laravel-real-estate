<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\LocalArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class LocationController extends Controller
{
public function Country()
{
    try{
        $country = Country::orderBy('name','ASC')->get();
        return view('backend.location.country',compact('country'));
    }catch (\Exception $e) {

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
}
public function StoreCountry(Request $request)
{
    try {

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:countries,name',
    ], [
        'name.required' => 'The country name field is required.',
        'name.string' => 'The country name must be a string.',
        'name.max' => 'The country name may not be greater than 255 characters.',
        'name.unique' => 'The country name is already in use.',
    ]);

    if ($validator->fails()) {

        $notification = [
            'message' => 'Validation failed : ' . $validator->errors()->first(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }


        // Start a database transaction
        DB::beginTransaction();

        Country::create([
            'name' => $request->name,
        ]);

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('country')->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method

public function EditCountry($id)
{

        try{

            $country = Country::findOrFail($id);
            return response()->json($country);

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

} // End Method
public function UpdateCountry(Request $request)
{

        $loc_id = $request->loc_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:countries,name,' . $loc_id,
        ], [
            'name.required' => 'The country name field is required.',
            'name.string' => 'The country name must be a string.',
            'name.max' => 'The country name may not be greater than 255 characters.',
            'name.unique' => 'The country name is already in use.',
        ]);

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

            Country::findOrFail($loc_id)->update([
                'name' => $request->name,

            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('country')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
} // End Method
public function DeleteCountry($id)
{

    try {
        // Start a database transaction
        DB::beginTransaction();

        $country = Country::findOrFail($id);
        $country->delete();

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => 'Error: '.$e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method


public function State()
{
    try{

        $state = State::orderBy('state_name','ASC')->get();
        $country = Country::orderBy('name','ASC')->get();
        return view('backend.location.state',compact('state','country'));

    }catch (\Exception $e) {

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
}
public function StoreState(Request $request)
{

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:states,state_name',
        'country' => 'required',
        'state_image' => 'required|image|mimes:jpeg,png,jpg',
    ], [
        'name.required' => 'The state name field is required.',
        'name.string' => 'The state name must be a string.',
        'name.max' => 'The state name may not be greater than 255 characters.',
        'name.unique' => 'The state name is already in use.',
        'country.required' => 'The country field is required.',
        'state_image.required' => 'The state image is required.',
        'state_image.image' => 'The selected file must be an image.',
        'state_image.mimes' => 'The state image must be a file of type: jpeg, png, jpg.',

    ]);


    if ($validator->fails()) {

        $notification = [
            'message' => 'Validation failed : ' . $validator->errors()->first(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
    try {

        if($request->file('state_image')){
            $image = $request->file('state_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize(1000, 1000);
            // Save the manipulated image
            $image->toJpeg()->save('upload/state_images/' . $name_gen);
            $save_url = 'upload/state_images/' . $name_gen;
        }

        // Start a database transaction
        DB::beginTransaction();

        State::create([
            'state_name' => $request->name,
            'country_id' => $request->country,
            'state_image' => $save_url,
        ]);

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('state')->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method

public function EditState($id)
{
        try{

            $state = State::findOrFail($id);
            return response()->json($state);

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

} // End Method

public function UpdateState(Request $request)
{

        $loc_id = $request->loc_id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:states,state_name,' . $loc_id,
            'country' => 'required',
            'state_image_edit' => 'nullable|image|mimes:jpeg,png,jpg',
        ], [
            'name.required' => 'The state name field is required.',
            'name.string' => 'The state name must be a string.',
            'name.max' => 'The state name may not be greater than 255 characters.',
            'name.unique' => 'The state name is already in use.',
            'country.required' => 'The country field is required.',
            'state_image_edit.image' => 'The selected file must be an image.',
            'state_image_edit.mimes' => 'The state image must be a file of type: jpeg, png, jpg.',

        ]);


        if ($validator->fails()) {

            $notification = [
                'message' => 'Validation failed : ' . $validator->errors()->first(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
        $save_url = $request->imageHidden;
        if($request->file('state_image_edit')){
            $image = $request->file('state_image_edit');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize(1000, 1000);
            // Save the manipulated image
            $image->toJpeg()->save('upload/state_images/' . $name_gen);
            $save_url = 'upload/state_images/' . $name_gen;
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            State::findOrFail($loc_id)->update([
                'state_name' => $request->name,
                'country_id' => $request->country,
                'state_image' => $save_url,

            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('state')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
} // End Method

public function DeleteState($id)
{

    try {
        // Start a database transaction
        DB::beginTransaction();

        $state = State::findOrFail($id);
        $state->delete();

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => 'Error: '.$e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method


public function City()
{
    try{

        $city = City::orderBy('name','ASC')->get();
        return view('backend.location.city',compact('city'));

    }catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
    }
}
public function StoreCity(Request $request)
{
    // dd($request->all());

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:cities,name',
        'country' => 'required',
        'state' => 'required',
    ], [
        'name.required' => 'The state name field is required.',
        'name.string' => 'The state name must be a string.',
        'name.max' => 'The state name may not be greater than 255 characters.',
        'name.unique' => 'The state name is already in use.',
        'country.required' => 'The country field is required.',
        'state.required' => 'The state is required.',

    ]);


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

        City::create([
            'name' => $request->name,
            'state_id' => $request->state,
        ]);

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('city')->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method

public function EditCity($id)
{
        try{

            $city = City::findOrFail($id);
            return response()->json($city);

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

} // End Method
public function UpdateCity(Request $request)
{

        $loc_id = $request->loc_id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:cities,name,'.$loc_id,
            'country' => 'required',
            'state' => 'required',
        ], [
            'name.required' => 'The state name field is required.',
            'name.string' => 'The state name must be a string.',
            'name.max' => 'The state name may not be greater than 255 characters.',
            'name.unique' => 'The state name is already in use.',
            'country.required' => 'The country field is required.',
            'state.required' => 'The state is required.',

        ]);

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

            City::findOrFail($loc_id)->update([
                'name' => $request->name,
                'state_id' => $request->state,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('city')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
} // End Method
public function DeleteCity($id)
{

    try {
        // Start a database transaction
        DB::beginTransaction();

        $city = City::findOrFail($id);
        $city->delete();

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => 'Error: '.$e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method

public function LocalArea()
{
    try{

        $localarea = LocalArea::orderBy('name','ASC')->get();
        return view('backend.location.localarea',compact('localarea'));

    }catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
    }
}
public function StoreLocalArea(Request $request)
{
    // dd($request->all());

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:local_areas,name',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
    ], [

        'name.required' => 'The state name field is required.',
        'name.string' => 'The state name must be a string.',
        'name.max' => 'The state name may not be greater than 255 characters.',
        'name.unique' => 'The state name is already in use.',
        'country.required' => 'The country field is required.',
        'state.required' => 'The state is required.',
        'city.required' => 'The city is required.',


    ]);


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

        LocalArea::create([
            'name' => $request->name,
            'city_id' => $request->city,

        ]);

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('local.area')->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method

public function EditLocalArea($id)
{
        try{

            $localarea = LocalArea::findOrFail($id);
            return response()->json($localarea);

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

} // End Method
public function UpdateLocalArea(Request $request)
{

        $loc_id = $request->loc_id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:local_areas,name,'.$loc_id,
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ], [

            'name.required' => 'The area name field is required.',
            'name.string' => 'The area name must be a string.',
            'name.max' => 'The area name may not be greater than 255 characters.',
            'name.unique' => 'The area name is already in use.',
            'country.required' => 'The country field is required.',
            'state.required' => 'The state is required.',
            'city.required' => 'The city is required.',


        ]);


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

            LocalArea::findOrFail($loc_id)->update([
                'name' => $request->name,
                'city_id' => $request->city,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('local.area')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
} // End Method
public function DeleteLocalArea($id)
{

    try {
        // Start a database transaction
        DB::beginTransaction();

        $area = LocalArea::findOrFail($id);
        $area->delete();

        // Commit the transaction
        DB::commit();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an exception
        DB::rollBack();

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => 'Error: '.$e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }
} // End Method


public function getCountryShow()
{
    $country = Country::orderBy('name','ASC')->get();
    return response()->json($country);
}
public function getStateShow()
{

    $states = State::orderBy('state_name','ASC')->get();
    return response()->json($states);
}
public function getCityShow()
{
    $city = City::orderBy('name','ASC')->get();
    return response()->json($city);
}
public function getSelectedState($countryId)
{
    $states = State::where('country_id', $countryId)->orderBy('state_name','ASC')->get();
    return response()->json($states);
}

public function getSelectedCity($stateId)
{
    $cities = City::where('state_id', $stateId)->orderBy('name','ASC')->get();
    return response()->json($cities);
}

public function getSelectedLocalArea($city_id)
{
    $localAreas = LocalArea::where('city_id', $city_id)->orderBy('name','ASC')->get();
    return response()->json($localAreas);
}
}
