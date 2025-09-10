<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Comment;
use App\Models\BlogPost;
use App\Models\SiteSetting;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function AllBlogCategory()
    {
        try{

            $category = BlogCategory::latest()->get();
            return view('backend.category.blog_category', compact('category'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Edit Agent method: '.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

    } // End Method


    public function StoreBlogCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:blog_categories,category_name',
        ], [
            'category_name.required' => 'The category name field is required.',
            'category_name.string' => 'The category name must be a string.',
            'category_name.max' => 'The category name may not be greater than 255 characters.',
            'category_name.unique' => 'The category name is already in use.',
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

            BlogCategory::create([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'BlogCategory Created Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.blog.category')->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error creating StoreBlogCategory Method: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function EditBlogCategory($id)
    {

        try{

            $categories = BlogCategory::findOrFail($id);
            return response()->json($categories);

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Edit Agent method: '.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }

    } // End Method


    public function UpdateBlogCategory(Request $request)
    {

        $cat_id = $request->cat_id;
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255|unique:blog_categories,category_name,' . $cat_id,
        ], [
            'category_name.required' => 'The category name field is required.',
            'category_name.string' => 'The category name must be a string.',
            'category_name.max' => 'The category name may not be greater than 255 characters.',
            'category_name.unique' => 'The category name is already in use.',
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

            BlogCategory::findOrFail($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'BlogCategory Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.blog.category')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error updating BlogCategory: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function DeleteBlogCategory($id)
    {

        try {
            // Start a database transaction
            DB::beginTransaction();

            $category = BlogCategory::findOrFail($id);
            $category->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'BlogCategory Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error deleting BlogCategory: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function AllPost()
    {
        try{

            $post = BlogPost::latest()->get();
            return view('backend.post.all_post', compact('post'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in All Post method: '.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }
    } // End Method

    public function AddPost()
    {
        try{
            $blogcat = BlogCategory::latest()->get();
            return view('backend.post.add_post', compact('blogcat'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Query exception in Add Post method: '.$e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);

        }
    } // End Method
    public function StorePost(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'blogcat_id' => 'required|exists:blog_categories,id',
            'post_title' => 'required|string|max:255|unique:blog_posts,post_title',
            'short_descp' => 'required|string|max:255',
            'long_descp' => 'required|string',
            'post_tags' => 'nullable|string|max:255',
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'blogcat_id.required' => 'The blog category field is required.',
            'blogcat_id.exists' => 'The selected blog category is invalid.',
            'post_title.required' => 'The post title field is required.',
            'post_title.string' => 'The post title must be a string.',
            'post_title.max' => 'The post title may not be greater than 255 characters.',
            'post_title.unique' => 'The post title is already in use.',
            'short_descp.required' => 'The short description field is required.',
            'short_descp.string' => 'The short description must be a string.',
            'short_descp.max' => 'The short description may not be greater than 255 characters.',
            'long_descp.required' => 'The long description field is required.',
            'long_descp.string' => 'The long description must be a string.',
            'post_tags.string' => 'The post tags must be a string.',
            'post_tags.max' => 'The post tags may not be greater than 255 characters.',
            'post_image.required' => 'The post image field is required.',
            'post_image.image' => 'The file must be an image.',
            'post_image.mimes' => 'The image must be of type jpeg, png, jpg, or gif.',
            'post_image.max' => 'The image may not be greater than 2048 kilobytes.',
        ]);

        try {

            // Start a database transaction
            DB::beginTransaction();

            // Your existing image upload and database insertion logic
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize(770, 520);
            // Save the manipulated image
            $image->toJpeg()->save('upload/post_images/' . $name_gen);
            $save_url = 'upload/post_images/' . $name_gen;

            // Insert the post data into the database
            BlogPost::insert([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_descp' => $request->short_descp,
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            // Commit the database transaction
            DB::commit();

            // Redirect with success notification
            $notification = array(
                'message' => 'BlogPost Inserted Successfully',
                'alert-type' => 'success'
            );
                return redirect()->route('all.post')->with($notification);

        } catch (\Exception $e) {
            // Rollback the database transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error creating Store Post: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function EditPost($encryptedId)
    {

        try {
            $id = decrypt($encryptedId);
            $blogcat = BlogCategory::latest()->get();
            $post = BlogPost::findOrFail($id);
            return view('backend.post.edit_post', compact('post', 'blogcat'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error creating Edit Post: ' .$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function UpdatePost(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'blogcat_id' => 'required|exists:blog_categories,id',
            'post_title' => 'required|string|max:255|unique:blog_posts,post_title,' . $request->id,
            'short_descp' => 'required|string|max:255',
            'long_descp' => 'required|string',
            'post_tags' => 'nullable|string|max:255',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'blogcat_id.required' => 'The blog category field is required.',
            'blogcat_id.exists' => 'The selected blog category is invalid.',
            'post_title.required' => 'The post title field is required.',
            'post_title.string' => 'The post title must be a string.',
            'post_title.max' => 'The post title may not be greater than 255 characters.',
            'post_title.unique' => 'The post title is already in use.',
            'short_descp.required' => 'The short description field is required.',
            'short_descp.string' => 'The short description must be a string.',
            'short_descp.max' => 'The short description may not be greater than 255 characters.',
            'long_descp.required' => 'The long description field is required.',
            'long_descp.string' => 'The long description must be a string.',
            'post_tags.string' => 'The post tags must be a string.',
            'post_tags.max' => 'The post tags may not be greater than 255 characters.',
            'post_image.image' => 'The file must be an image.',
            'post_image.mimes' => 'The image must be of type jpeg, png, jpg, or gif.',
            'post_image.max' => 'The image may not be greater than 2048 kilobytes.',
        ]);


        $post_id = $request->id;
        try{

            // Start a database transaction
            DB::beginTransaction();

            if ($request->file('post_image')) {

                $image = $request->file('post_image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $image = $manager->read($image)->resize(770, 520);
                // Save the manipulated image
                $image->toJpeg()->save('upload/post_images/' . $name_gen);
                $save_url = 'upload/post_images/' . $name_gen;

                BlogPost::findOrFail($post_id)->update([
                    'blogcat_id' => $request->blogcat_id,
                    'user_id' => Auth::user()->id,
                    'post_title' => $request->post_title,
                    'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                    'short_descp' => $request->short_descp,
                    'long_descp' => $request->long_descp,
                    'post_tags' => $request->post_tags,
                    'post_image' => $save_url,
                    'created_at' => Carbon::now(),
                ]);

                $notification = array(
                    'message' => 'BlogPost Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.post')->with($notification);
            } else {

                BlogPost::findOrFail($post_id)->update([
                    'blogcat_id' => $request->blogcat_id,
                    'user_id' => Auth::user()->id,
                    'post_title' => $request->post_title,
                    'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                    'short_descp' => $request->short_descp,
                    'long_descp' => $request->long_descp,
                    'post_tags' => $request->post_tags,
                    'created_at' => Carbon::now(),
                ]);

                // Commit the database transaction
                DB::commit();

                $notification = array(
                    'message' => 'BlogPost Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.post')->with($notification);
            }
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error creating update Post: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method

    public function DeletePost($encryptedId)
    {

        try {
            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            $post = BlogPost::findOrFail($id);
            $img = $post->post_image;

            // Check if the image file exists before attempting to delete
            if (file_exists($img)) {
                unlink($img);
            }

            // Use delete method directly on the retrieved model to delete from the database
            $post->delete();

            // Commit the database transaction
            DB::commit();

            $notification = [
                'message' => 'BlogPost Deleted Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (\Exception $e) {
            // Rollback the database transaction in case of a query exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error deleting BlogPost: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function BlogDetails($slug){

        try {
                $blog = BlogPost::where('post_slug',$slug)->first();
                $tags = $blog->post_tags;
                $tags_all = explode(',',$tags);
                $bcategory = BlogCategory::orderBy('category_name','ASC')->get();;
                $dpost = BlogPost::latest()->limit(3)->get();
                $sitesetting = SiteSetting::find(1);
                $page_title = $blog->post_title;

                return view('frontend.blog.blog_details',compact('blog','page_title','tags_all','bcategory','dpost','sitesetting'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error BlogDetails: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }// End Method

    public function BlogCatList($encryptedId){

        try {
            $id = decrypt($encryptedId);
            $blog = BlogPost::where('blogcat_id',$id)->orderBy('id','DESC')->paginate(5);
            $breadcat = BlogCategory::where('id',$id)->first();
            $bcategory = BlogCategory::orderBy('category_name','ASC')->get();
            $page_title = $breadcat->category_name;
            $dpost = BlogPost::latest()->limit(3)->get();
            $sitesetting = SiteSetting::find(1);

            return view('frontend.blog.blog_cat_list', compact('blog','page_title','sitesetting','breadcat','bcategory','dpost'));
        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error BlogCatList: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }// End Method
    public function BlogTag($tag){

        try {
        $blog = BlogPost::where('post_tags','like',"%{$tag}%")->orderBy('id','DESC')->paginate(5);
        $bcategory = BlogCategory::orderBy('category_name','ASC')->get();
        $page_title = $tag;
        $dpost = BlogPost::latest()->limit(3)->get();
        $sitesetting = SiteSetting::find(1);

        return view('frontend.blog.blog_tag_list', compact('blog','page_title','sitesetting','bcategory','dpost'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error BlogTag: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }// End Method


    public function BlogList(Request $request){

        try {

            $search = $request['search_field'];
           //dd($search);
            $query = BlogPost::query();

            if ($search) {
                $query->where('post_title', 'LIKE', '%'.$search.'%')->orWhere('long_descp', 'LIKE', '%'.$search.'%');
            }

            $blog = $query->latest()->paginate(5);
            $page_title = 'Blog List';
            $bcategory = BlogCategory::latest()->get();
            $dpost = BlogPost::latest()->limit(3)->get();
            $sitesetting = SiteSetting::find(1);

            return view('frontend.blog.blog_list', compact('blog','sitesetting','bcategory','dpost','page_title'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error BlogList: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }// End Method


    public function StoreComment(Request $request){

       // dd($request->all());

        try {
             // Validate the incoming request data
                $request->validate([
                    'post_id' => 'required',
                    'subject' => 'required|string|max:255',
                    'message' => 'required|string',
                ]);
                $pid = $request->post_id;

                if (Auth::check() && Auth::user()->role === 'user') {

                    Comment::insert([
                        'user_id' => Auth::user()->id,
                        'post_id' => $pid,
                        'parent_id' => null,
                        'subject' => $request->subject,
                        'message' => $request->message,
                        'created_at' => Carbon::now(),

                    ]);

                    $notification = array(
                        'message' => 'Comment Inserted Successfully',
                        'alert-type' => 'success'
                    );

                    return redirect()->back()->with($notification);
                } else {

                    $notification = array(
                        'message' => 'Login Your Account First',
                        'alert-type' => 'error'
                    );

                    return redirect()->back()->with($notification);
                }
        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error Store Comment: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }// End Method

    public function AdminBlogComment(){

        try {

            $comment = Comment::where('parent_id',null)->orderBy('id','DESC')->get();

            return view('backend.comment.comment_all',compact('comment'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error AdminBlogComment: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }


    }// End Method

    public function AdminCommentReply($encryptedId){
        try {
            $id = decrypt($encryptedId);
            $comment = Comment::where('id',$id)->first();
            return view('backend.comment.reply_comment',compact('comment'));

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error AdminBlogComment: '.$e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    }// End Method

    public function ReplyMessage(Request $request)
    {
        try {

            $id = $request->id;
            $user_id = $request->user_id;
            $post_id = $request->post_id;


            $request->validate([
                'id' => 'required',
                'user_id' => 'required',
                'post_id' => 'required',
                // 'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ], [
                'id.required' => 'The comment ID is required.',
                'user_id.required' => 'The user ID is required.',
                'post_id.required' => 'The post ID is required.',
                // 'subject.required' => 'The subject field is required.',
                // 'subject.string' => 'The subject must be a string.',
                // 'subject.max' => 'The subject may not be greater than 255 characters.',
                'message.required' => 'The message field is required.',
                'message.string' => 'The message must be a string.',
            ]);

            // Check if a comment with the specified parent ID exists
            $existingComment = Comment::where('parent_id', $id)->first();

            if (!$existingComment) {
                // Update the status of the original comment
                Comment::where('id', $id)->update(['status' => 'reply']);

                // Insert a new comment as a reply
                Comment::insert([
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'parent_id' => $id,
                    // 'subject' => $request->subject,
                    'message' => $request->message,
                    'created_at' => now(),
                ]);

                $notification = [
                    'message' => 'Reply Successfully',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
            } else {
                // update an existing comment as a reply
                $existingComment->update([
                    'user_id' => $user_id,
                    'post_id' => $post_id,
                    'parent_id' => $id,
                    // 'subject' => $request->subject,
                    'message' => $request->message,
                    'created_at' => now(),
                ]);

                // Commit the transaction
                DB::commit();

                $notification = [
                    'message' => 'Reply updated Successfully',
                    'alert-type' => 'success',
                ];

                return redirect(route('admin.blog.comment'))->with($notification);
            }

        } catch (\Exception $e) {
            DB::rollback();

            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect(route('admin.blog.comment'))->with($notification);
        }
    }



}
