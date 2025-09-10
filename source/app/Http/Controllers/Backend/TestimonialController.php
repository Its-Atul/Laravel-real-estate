<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    public function AllTestimonials()
    {
        try {

            $testimonial = Testimonial::latest()->get();
            return view('backend.testimonial.all_testimonial', compact('testimonial'));

        }catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in All Testimonials method: ' .$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AddTestimonials()
    {
        try {

            return view('backend.testimonial.add_testimonial');

        }catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Add Testimonials method: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function StoreTestimonials(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'position.required' => 'The position field is required.',
            'position.string' => 'The position must be a string.',
            'position.max' => 'The position may not be greater than 255 characters.',
            'message.required' => 'The message field is required.',
            'message.string' => 'The message must be a string.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be of type mimes.',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Your existing logic for image manipulation and saving
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize(100, 100);
            $image->toJpeg()->save('upload/testimonial_image/' . $name_gen);
            $save_url = 'upload/testimonial_image/' . $name_gen;

            // Insert data into the database within the transaction
            Testimonial::insert([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $save_url,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Testimonial Inserted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.testimonials')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

           // Handle the exception, you might want to log it or provide a generic error message
           $notification = [
            'message' => 'Query exception in Store Testimonials method: ' .$e->getMessage(),
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
        }
    } // End Method


    public function EditTestimonials($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            $testimonial = Testimonial::findOrFail($id);
            return view('backend.testimonial.edit_testimonial', compact('testimonial'));

        } catch (\Exception $e) {

        // Handle the exception, you might want to log it or provide a generic error message
        $notification = [
            'message' => 'Query exception in Edit Testimonials method: ' .$e->getMessage(),
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);

        }
    } // End Method


    public function UpdateTestimonials(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'position.required' => 'The position field is required.',
            'position.string' => 'The position must be a string.',
            'position.max' => 'The position may not be greater than 255 characters.',
            'message.required' => 'The message field is required.',
            'message.string' => 'The message must be a string.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be of type mimes.',
        ]);

       // dd($request->all());
        try {
            // Start a database transaction
            DB::beginTransaction();
            $id = $request->id;
            $UdateTestmonial = Testimonial::findOrFail($id);
            // Your existing logic for image manipulation and saving
            $imageSave = 'Test Update';
            if ($request->file('image')) {
                $image = $request->file('image');
                 @unlink(public_path('upload/testimonial_image/'.$UdateTestmonial->image));
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image)->resize(100, 100);
                $image->toJpeg()->save('upload/testimonial_image/' . $name_gen);
                $imageSave = 'upload/testimonial_image/' . $name_gen;
            }

                $UdateTestmonial->update([

                    'name' => $request->name,
                    'position' => $request->position,
                    'message' => $request->message,
                    'image' => $imageSave
                ]);

                $notification = array(
                    'message' => 'Testimonial Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('all.testimonials')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

           // Handle the exception, you might want to log it or provide a generic error message
           $notification = [
            'message' => 'Query exception in Update Testimonials method: ' .$e->getMessage(),
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
        }
    } // End Method

    public function DeleteTestimonials($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            $testimonial = Testimonial::findOrFail($id);

            // Check if the image file exists before attempting to delete
            $imagePath = public_path('upload/testimonial_image/' . $testimonial->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $testimonial->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Testimonial Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Log the exception for further investigation
            logger()->error('Error deleting testimonial: ' . $e->getMessage());

            $notification = [
                'message' => 'Error deleting testimonial. Please try again later.',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }




}
