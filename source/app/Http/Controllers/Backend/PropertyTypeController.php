<?php

namespace App\Http\Controllers\Backend;

use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PropertyTypeController extends Controller
{
    public function AllType()
    {
        try {

            $types = PropertyType::latest()->get();
            return view('backend.type.all_type', compact('types'));

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in all type method: '.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AddType()
    {
        try {

            return view('backend.type.add_type');

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in add type method: '.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function StoreType(Request $request)
    {
        try {

            // Validation
            $request->validate([
                'type_name' => 'required|unique:property_types|max:250',
                'type_icon' => 'required|max:250',
            ], [
                'type_name.required' => 'Please enter property type name.',
                'type_name.unique' => 'The type name has already been taken.',
                'type_name.max' => 'The type name must not be greater than 250 characters.',
                'type_icon.required' => 'Please enter type icon.',
                'type_icon.max' => 'The type name must not be greater than 250 characters.',
            ]);

            // Begin a database transaction
            DB::beginTransaction();

            // Database insertion
            PropertyType::insert([
                'type_name' => $request->type_name,
                'type_icon' => $request->type_icon,
            ]);
             // Commit the transaction if everything is successful
            DB::commit();

            $notification = [
                'message' => 'Property Type Created Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.type')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in store type method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function EditType($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            $types = PropertyType::findOrFail($id);
            return view('backend.type.edit_type', compact('types'));

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in edit type method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method

    public function UpdateType(Request $request)
    {
        try {
                // Validation
                $request->validate([
                    'id' => 'required|exists:property_types,id',
                    'type_name' => 'required|unique:property_types,type_name,' . $request->id . '|max:250',
                    'type_icon' => 'required|max:250',
                ], [
                    'id.required' => 'Property type ID is required.',
                    'id.exists' => 'Invalid property type ID.',
                    'type_name.required' => 'Please enter property type name.',
                    'type_name.unique' => 'The type name has already been taken.',
                    'type_name.max' => 'The type name must not be greater than 250 characters.',
                    'type_icon.required' => 'Please enter type icon.',
                    'type_icon.max' => 'The type icon must not be greater than 250 characters.',
                ]);

                // Begin a database transaction
                DB::beginTransaction();

                $pid = $request->id;
                PropertyType::findOrFail($pid)->update([

                    'type_name' => $request->type_name,
                    'type_icon' => $request->type_icon,
                ]);

                // Commit the transaction if everything is successful
                DB::commit();

                $notification = array(
                    'message' => 'Property Type Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.type')->with($notification);

            } catch (\Exception $e) {

                // Rollback the transaction if an exception occurs
                DB::rollBack();

                // Handle the exception, you might want to log it or provide a generic error message
                $notification = [
                    'message' => 'Query exception in update type method: ' .$e->getMessage(),
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }
    } // End Method

    public function DeleteType($encryptedId)
    {
        try {

                $id = decrypt($encryptedId);
                // Begin a database transaction
                DB::beginTransaction();

                PropertyType::findOrFail($id)->delete();

                // Commit the transaction if everything is successful
                DB::commit();

                $notification = array(
                    'message' => 'Property Type Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            } catch (\Exception $e) {

                // Rollback the transaction if an exception occurs
                DB::rollBack();
                // Handle the exception, you might want to log it or provide a generic error message
                $notification = [
                    'message' => 'Query exception in Delete type method: ' .$e->getMessage(),
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }

    } // End Method

    public function AllAmenitie()
    {
        try{

            $amenities = Amenities::latest()->get();
            return view('backend.amenities.all_amenities', compact('amenities'));

        }catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in all amenitie method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AddAmenitie()
    {
        try{

            return view('backend.amenities.add_amenities');

            } catch (\Exception $e) {
                // Handle the exception, you might want to log it or provide a generic error message
                $notification = [
                    'message' => 'Query exception in add amenitie method: ' .$e->getMessage(),
                    'alert-type' => 'error'
                ];

                return redirect()->back()->with($notification);
            }
    } // End Method
    public function StoreAmenitie(Request $request)
    {
        try {

            // Validation
            $request->validate([
                'amenitis_name' => 'required|unique:amenities,amenitis_name|max:250',
            ], [
                'amenitis_name.required' => 'Please enter amenities name.',
                'amenitis_name.unique' => 'The type name has already been taken.',
                'amenitis_name.max' => 'The amenities name must not be greater than 250 characters.',
            ]);

            // Begin a database transaction
            DB::beginTransaction();

            // Database insertion
            Amenities::insert([
                'amenitis_name' => $request->amenitis_name,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            $notification = [
                'message' => 'Amenities Created Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.amenitie')->with($notification);

        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in store amenitie method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function EditAmenitie($encryptedId)
    {
        try{

            $id = decrypt($encryptedId);
            $amenities = Amenities::findOrFail($id);
            return view('backend.amenities.edit_amenities', compact('amenities'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in store amenitie method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function UpdateAmenitie(Request $request)
    {
        try {
                // Validation
                $request->validate([

                    'amenitis_name' => 'required|unique:amenities,amenitis_name,' . $request->id . '|max:250',
                ], [
                    'amenitis_name.required' => 'Please enter amenities name.',
                    'amenitis_name.unique' => 'The type name has already been taken.',
                    'amenitis_name.max' => 'The amenities name must not be greater than 250 characters.',
                ]);

                // Begin a database transaction
                DB::beginTransaction();

            $ame_id = $request->id;

            Amenities::findOrFail($ame_id)->update([

                'amenitis_name' => $request->amenitis_name,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            $notification = array(
                'message' => 'Amenities Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.amenitie')->with($notification);
        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in store amenitie method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function DeleteAmenitie($encryptedId)
    {

        try {
                $id = decrypt($encryptedId);
                 // Begin a database transaction
                 DB::beginTransaction();

                Amenities::findOrFail($id)->delete();

                // Commit the transaction if everything is successful
                DB::commit();
                $notification = array(
                    'message' => 'Amenities Deleted Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
        } catch (\Exception $e) {

            // Rollback the transaction if an exception occurs
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in store amenitie method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method
}
