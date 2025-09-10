<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\PropertyTypeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//User Frontend all Route
Route::get('/', [UserController::class, 'Index']);

Route::controller(IndexController::class)->group(function(){

    Route::get('/property/details/{id}/{slug}','PropertyDetails');
    Route::post('/property/message', 'PropertyMessage')->name('property.message');
    Route::get('/agent/details/{id}','AgentDetails')->name('agent.details');
    Route::get('/rent/property', 'RentProperty')->name('rent.property');
    Route::get('/buy/property', 'BuyProperty')->name('buy.property');
    Route::get('/property/type/{id}', 'PropertyType')->name('property.type');
    Route::get('/state/details/{id}', 'StateDetails')->name('state.details');
    Route::post('/store/schedule','StoreSchedule')->name('store.schedule');

    Route::get('/all/property/type','AllPropertyType')->name('all.property.type');
    Route::get('/all/property/listing','AllPropertyListing')->name('all.property.listing');

    Route::get('/privacy_policy','PrivacyPolicy')->name('privacy.policy');
    Route::get('/term_service','TermService')->name('term.service');
    Route::get('/aboutus','AboutUs')->name('about.us');
    Route::get('/agent/list','AgentList')->name('agent.list');
    Route::get('/contact','ContactUs')->name('contact.us');
    Route::post('/contact','ContactStore')->name('contact.store');

    Route::get('/amenities/{id}','amenityProperty')->name('amenities');
    Route::get('/inactive/account','InactiveAccount')->name('inactive.account');

    Route::get('/currency_symbol','currencySymbol')->name('currency.symbol');

});

Route::controller(WishlistController::class)->group(function(){
    Route::post('/add-to-wishList/{property_id}', 'AddToWishList');
});

Route::controller(CompareController::class)->group(function(){

    Route::post('/add-to-compare/{property_id}','AddToCompare');
});

Route::controller(BlogController::class)->group(function(){

    Route::get('/blog/details/{slug}', 'BlogDetails');
    Route::get('/blog/cat/list/{id}', 'BlogCatList');
    Route::get('/blog', 'BlogList')->name('blog.list');
    Route::get('/blog/tag/{tag}', 'BlogTag')->name('blog.tag');
    Route::post('/store/comment', 'StoreComment')->name('store.comment');

});
//Location
Route::controller(LocationController::class)->group(function(){

    Route::get('/getCountryShow', 'getCountryShow');
    Route::get('/getStateShow','getStateShow');
    Route::get('/getCityShow','getCityShow');

    Route::get('/getSelectedState/{countryId}','getSelectedState');
    Route::get('/getSelectedCity/{stateId}','getSelectedCity');
    Route::get('/getSelectedLocalArea/{cityId}','getSelectedLocalArea');

});

require __DIR__ . '/auth.php';

Route::middleware(['auth','checkUserStatus','verified','roles:user','prevent-back-history'])->group(function () {


    // User Type All Route
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', 'UserDashboard')->name('dashboard');
        Route::get('/user/profile', 'UserProfile')->name('user.profile');
        Route::post('/user/profile/store', 'UserProfileStore')->name('user.profile.store');
        Route::get('/user/logout', 'UserLogout')->name('user.logout');
        Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
        Route::post('/user/password/update', 'UserPasswordUpdate')->name('user.password.update');
        Route::get('/user/schedule/request','UserScheduleRequest')->name('user.schedule.request');
    });
    // User WishlistAll Route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-property', 'GetWishlistProperty');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });

    // User Compare All Route
    Route::controller(CompareController::class)->group(function () {
        Route::get('/user/compare', 'UserCompare')->name('user.compare');
        Route::get('/get-compare-property', 'GetCompareProperty');
        Route::get('/compare-remove/{id}', 'CompareRemove');
    });
});

// Admin Group  Middleware
Route::middleware(['auth','verified','roles:admin','prevent-back-history'])->group(function () {

    // Admin Type All Route
    Route::controller(AdminController::class)->group(function () {

        Route::get('/admin/dashboard', 'AdminDashboard')->name('admin.dashboard');
        Route::get('/admin/logout', 'AdminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/profile/store', 'AdminProfileStore')->name('admin.profile.store');
        Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');
        Route::post('/admin/update/password', 'AdminUpdatePassword')->name('admin.update.password');

        Route::get('/register/agent', 'AllAgent')->name('register.agent')->middleware('permission:register.agent');
        //Route::get('/add/agent', 'AddAgent')->name('add.agent')->middleware('permission:agent.add');
        //Route::post('/store/agent', 'StoreAgent')->name('store.agent');
        //Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent')->middleware('permission:agent.edit');
        //Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
        Route::get('/agent_details/{id}', 'AgentDetails')->name('agent_details')->middleware('permission:agent.details');
        Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent')->middleware('permission:agent.delete');
        Route::get('/changeStatus', 'changeStatus')->middleware('permission:agent.status.change');

        Route::get('/register/user', 'AllUser')->name('register.user')->middleware('permission:register.user');
        Route::get('/user/details/{id}', 'userDetails')->name('user.details')->middleware('permission:user.details');
        Route::get('/delete/user/{id}', 'Deleteuser')->name('delete.user')->middleware('permission:user.delete');
        Route::get('/changeUserStatus', 'changeUserStatus')->middleware('permission:user.status.change');

        Route::get('/all/admin', 'AllAdmin')->name('all.admin')->middleware('permission:admin.user.all');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin')->middleware('permission:admin.user.add');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin')->middleware('permission:admin.user.edit');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin')->middleware('permission:admin.user.delete');
    });

    // Property Type All Route
    Route::controller(PropertyTypeController::class)->group(function () {

        Route::get('/all/type', 'AllType')->name('all.type')->middleware('permission:property.type.all');
        Route::get('/add/type', 'AddType')->name('add.type')->middleware('permission:property.type.add');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type')->middleware('permission:property.type.edit');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type')->middleware('permission:property.type.delete');

        Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie')->middleware('permission:amenitie.all');
        Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie')->middleware('permission:amenitie.add');
        Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
        Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie')->middleware('permission:amenitie.edit');
        Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
        Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie')->middleware('permission:amenitie.delete');
    });

    // Property All Route
    Route::controller(PropertyController::class)->group(function () {

        Route::get('/all/property', 'AllProperty')->name('all.property')->middleware('permission:property.all');
        Route::get('/add/property', 'AddProperty')->name('add.property')->middleware('permission:property.add');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property')->middleware('permission:property.edit');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::post('/update/property/thambnail', 'UpdatePropertyThambnail')->name('update.property.thambnail');
        Route::post('/update/property/multiimage', 'UpdatePropertyMultiimage')->name('update.property.multiimage');
        Route::get('/property/multiimg/delete/{id}', 'PropertyMultiImageDelete')->name('property.multiimg.delete');
        Route::post('/store/new/multiimage', 'StoreNewMultiimage')->name('store.new.multiimage');
        Route::post('/update/property/facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property')->middleware('permission:property.delete');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');
        Route::post('/active/property', 'ActiveProperty')->name('active.property');
        Route::get('/admin/package/history', 'AdminPackageHistory')->name('admin.package.history')->middleware('permission:package.history');
        Route::get('/package/invoice/{id}', 'PackageInvoice')->name('package.invoice')->middleware('permission:package.history.download');

        Route::get('/admin/property/message/', 'AdminPropertyMessage')->name('admin.property.message')->middleware('permission:message.all');
        Route::get('/admin/message/details/{id}', 'AdminMessageDetails')->name('admin.message.details')->middleware('permission:message.details');
        Route::get('/admin/message/delete/{id}', 'AdminMessageDetele')->name('admin.message.delete')->middleware('permission:message.delete');

        Route::get('/admin/schedule/request/', 'AdminScheduleRequest')->name('admin.schedule.request')->middleware('permission:schedule.all');
        Route::get('/admin/details/schedule/{id}', 'AdminDetailsSchedule')->name('admin.details.schedule')->middleware('permission:schedule.details');
        Route::post('/admin/update/schedule/', 'AdminUpdateSchedule')->name('admin.update.schedule');
        Route::get('/admin/delete/schedule/{id}', 'AdminDeteleSchedule')->name('admin.delete.schedule')->middleware('permission:schedule.detele');;

    });

    // Testimonials  All Route
    Route::controller(TestimonialController::class)->group(function () {

        Route::get('/all/testimonials', 'AllTestimonials')->name('all.testimonials')->middleware('permission:testimonials.all');
        Route::get('/add/testimonials', 'AddTestimonials')->name('add.testimonials')->middleware('permission:testimonials.add');
        Route::post('/store/testimonials', 'StoreTestimonials')->name('store.testimonials');
        Route::get('/edit/testimonials/{id}', 'EditTestimonials')->name('edit.testimonials')->middleware('permission:testimonials.edit');
        Route::post('/update/testimonials', 'UpdateTestimonials')->name('update.testimonials');
        Route::get('/delete/testimonials/{id}', 'DeleteTestimonials')->name('delete.testimonials')->middleware('permission:testimonials.delete');
    });

    // Blog Cateory All Route
    Route::controller(BlogController::class)->group(function () {

        Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category')->middleware('permission:blog.category.all');
        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('/blog/category/{id}', 'EditBlogCategory')->middleware('permission:blog.category.edit');
        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category')->middleware('permission:blog.category.delete');

        Route::get('/all/post', 'AllPost')->name('all.post')->middleware('permission:blog.post.all');
        Route::get('/add/post', 'AddPost')->name('add.post')->middleware('permission:blog.post.add');
        Route::post('/store/post', 'StorePost')->name('store.post');
        Route::get('/edit/post/{id}', 'EditPost')->name('edit.post')->middleware('permission:blog.post.edit');
        Route::post('/update/post', 'UpdatePost')->name('update.post');
        Route::get('/delete/post/{id}', 'DeletePost')->name('delete.post')->middleware('permission:blog.post.delete');

        Route::get('/admin/blog/comment', 'AdminBlogComment')->name('admin.blog.comment')->middleware('permission:blog.comment.all');
        Route::get('/admin/comment/reply/{id}', 'AdminCommentReply')->name('admin.comment.reply')->middleware('permission:blog.comment.reply');
        Route::post('/reply/message', 'ReplyMessage')->name('reply.message');
    });

    // Setting  All Route
    Route::controller(SettingController::class)->group(function(){

        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting')->middleware('permission:setting.smtp');
        Route::post('/update/smpt/setting', 'UpdateSmtpSetting')->name('update.smpt.setting');
        Route::get('/site/setting', 'SiteSetting')->name('site.setting')->middleware('permission:setting.site');
        Route::post('/update/site/setting', 'UpdateSiteSetting')->name('update.site.setting');

        Route::get('/all/contact', 'AllContact')->name('all.contact')->middleware('permission:contact.all');
        Route::get('/admin/contact/details/{id}', 'ContactDetails')->name('admin.contact.details')->middleware('permission:contact.details');
        Route::get('/admin/contact/delete/{id}', 'ContactDetele')->name('admin.contact.delete')->middleware('permission:contact.delete');

        Route::get('/term_service/setting', 'TermService')->name('site.term_service')->middleware('permission:setting.term_service');
        Route::post('update/term_service/setting', 'UpdateTermService')->name('site.update.term_service')->middleware('permission:setting.term_service');

        Route::get('/privacy_policy/setting', 'PrivacyPolicy')->name('site.privacy_policy')->middleware('permission:setting.privacy_policy');
        Route::post('update/privacy_policy/setting', 'UpdatePrivacyPolicy')->name('site.update.privacy_policy')->middleware('permission:setting.privacy_policy');

        Route::get('/package/setting', 'PackageSetting')->name('package.setting')->middleware('permission:setting.package');
        Route::get('/edit/package/{id}', 'PackageEdit')->name('package.edit')->middleware('permission:edit.package');
        Route::post('update/package/', 'UpdatePackage')->name('update.package');

        Route::get('/banner', 'Banner')->name('banner')->middleware('permission:setting.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');

    });
     // Permission All Route
    Route::controller(RoleController::class)->group(function(){

        Route::get('/all/permission', 'AllPermission')->name('all.permission')->middleware('permission:permission.all');
        Route::get('/add/permission', 'AddPermission')->name('add.permission')->middleware('permission:permission.add');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission')->middleware('permission:permission.edit');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission')->middleware('permission:permission.delete');

        Route::get('/import/permission', 'ImportPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');

    });

    // Roles All Route
    Route::controller(RoleController::class)->group(function(){

            Route::get('/all/roles', 'AllRoles')->name('all.roles')->middleware('permission:role.all');
            Route::get('/add/roles', 'AddRoles')->name('add.roles')->middleware('permission:role.add');
            Route::post('/store/roles', 'StoreRoles')->name('store.roles');
            Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles')->middleware('permission:role.edit');
            Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
            Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles')->middleware('permission:role.delete');

            Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission')->middleware('permission:role.permission.add');
            Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
            Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission')->middleware('permission:role.permission.all');
            Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles')->middleware('permission:role.permission.edit');
            Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
            Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles')->middleware('permission:role.permission.delete');

        });

    //Location
    Route::controller(LocationController::class)->group(function(){
        Route::get('/country', 'Country')->name('country')->middleware('permission:country');
        Route::post('/country', 'StoreCountry')->name('store.country');
        Route::get('/country/{id}', 'EditCountry')->name('edit.country')->middleware('permission:edit.country');
        Route::post('/update/country', 'UpdateCountry')->name('update.country');
        Route::get('/delete/country/{id}', 'DeleteCountry')->name('delete.country')->middleware('permission:delete.country');

        Route::get('/state', 'state')->name('state')->middleware('permission:state');
        Route::post('/state', 'StoreState')->name('store.state');
        Route::get('/state/{id}', 'EditState')->name('edit.state')->middleware('permission:edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state')->middleware('permission:delete.state');

        Route::get('/city', 'City')->name('city')->middleware('permission:city');
        Route::post('/city', 'StoreCity')->name('store.city');
        Route::get('/city/{id}', 'EditCity')->name('edit.city')->middleware('permission:edit.city');
        Route::post('/update/city', 'UpdateCity')->name('update.city');
        Route::get('/delete/city/{id}', 'DeleteCity')->name('delete.city')->middleware('permission:delete.city');

        Route::get('/local/area', 'LocalArea')->name('local.area')->middleware('permission:local_area');
        Route::post('/local/area', 'StoreLocalArea')->name('store.local.area');
        Route::get('/local/area/{id}', 'EditLocalArea')->name('edit.local.area')->middleware('permission:edit.local_area');
        Route::post('/update/local/area', 'UpdateLocalArea')->name('update.local.area');
        Route::get('/delete/local/area/{id}', 'DeleteLocalArea')->name('delete.local.area')->middleware('permission:delete.local_area');

    });


}); //End Group Admin Middleware

// Agent Group  Middleware
Route::middleware(['auth','verified','checkUserStatus','roles:agent','prevent-back-history'])->group(function () {

    Route::controller(AgentController::class)->group(function () {
        Route::get('/agent/dashboard', 'AgentDashboard')->name('agent.dashboard');
        Route::get('/agent/logout', 'AgentLogout')->name('agent.logout');
        Route::get('/agent/profile', 'AgentProfile')->name('agent.profile');
        Route::post('/agent/profile/store', 'AgentProfileStore')->name('agent.profile.store');
        Route::get('/agent/change/password', 'AgentChangePassword')->name('agent.change.password');
        Route::post('/agent/update/password', 'AgentUpdatePassword')->name('agent.update.password');

    });

    Route::controller(AgentPropertyController::class)->group(function () {

        Route::get('/agent/all/property', 'AgentAllProperty')->name('agent.all.property');
        Route::get('/agent/add/property', 'AgentAddProperty')->name('agent.add.property');
        Route::get('/agent/all/property', 'AgentAllProperty')->name('agent.all.property');
        Route::get('/agent/add/property', 'AgentAddProperty')->name('agent.add.property');
        Route::post('/agent/store/property', 'AgentStoreProperty')->name('agent.store.property');
        Route::get('/agent/edit/property/{id}', 'AgentEditProperty')->name('agent.edit.property');
        Route::post('/agent/update/property', 'AgentUpdateProperty')->name('agent.update.property');
        Route::post('/agent/update/property/thambnail', 'AgentUpdatePropertyThambnail')->name('agent.update.property.thambnail');
        Route::post('/agent/update/property/multiimage', 'AgentUpdatePropertyMultiimage')->name('agent.update.property.multiimage');
        Route::get('/agent/property/multiimg/delete/{id}', 'AgentPropertyMultiimgDelete')->name('agent.property.multiimg.delete');
        Route::post('/agent/store/new/multiimage', 'AgentStoreNewMultiimage')->name('agent.store.new.multiimage');
        Route::post('/agent/update/property/facilities', 'AgentUpdatePropertyFacilities')->name('agent.update.property.facilities');
        Route::get('/agent/details/property/{id}', 'AgentDetailsProperty')->name('agent.details.property');

        Route::post('/agent/active/property', 'AgentActiveProperty')->name('agent.active.property');
        Route::post('/agent/inactive/property', 'AgentInActiveProperty')->name('agent.inactive.property');

        Route::get('/agent/delete/property/{id}', 'AgentDeleteProperty')->name('agent.delete.property');
        Route::get('/agent/property/message/', 'AgentPropertyMessage')->name('agent.property.message');
        Route::get('/buy/package', 'BuyPackage')->name('buy.package');
        Route::get('/buy/basic/plan', 'BuyBasicPlan')->name('buy.basic.plan');
        Route::get('/buy/business/plan', 'BuyBusinessPlan')->name('buy.business.plan');
        Route::get('/buy/professional/plan', 'BuyProfessionalPlan')->name('buy.professional.plan');
        Route::post('/store/plan', 'StorePlan')->name('store.plan');
        Route::get('/package/history', 'PackageHistory')->name('package.history');
        Route::get('/agent/package/invoice/{id}', 'AgentPackageInvoice')->name('agent.package.invoice');
        Route::get('/agent/message/details/{id}', 'AgentMessageDetails')->name('agent.message.details');
        Route::get('/agent/message/delete/{id}', 'AgentMessageDetele')->name('agent.message.delete');

        Route::get('/agent/schedule/request/', 'AgentScheduleRequest')->name('agent.schedule.request');
        Route::get('/agent/details/schedule/{id}', 'AgentDetailsSchedule')->name('agent.details.schedule');
        Route::post('/agent/update/schedule/', 'AgentUpdateSchedule')->name('agent.update.schedule');
        Route::get('/agent/delete/schedule/{id}', 'AgentDeteleSchedule')->name('agent.delete.schedule');
    });
}); //End Group Agent Middleware



