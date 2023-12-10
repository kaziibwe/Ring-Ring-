<?php

use App\Models\delivery;
use App\Models\deliveryman;
use App\Models\subcategory;
use App\Models\payOnDelivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FrontendController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\SideAdvertController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DeliverymanController;
use App\Http\Controllers\ProductsizeController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\OrderWithCashController;
use App\Http\Controllers\PayOnDeliveryController;
use App\Http\Controllers\ProductgalleryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\store;

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

$admin = 'admin';
$s_admin = 's_admin';
$store = 'store';
$deliveryman = 'deliveryman';
$supplier = 'supplier';



// Route::get('/', function () {
//     return view('front_end.front.index');
// });

// route to display the
//route to show  categories front end
Route::get('/', [FrontendController::class, 'viewAll'])->name('font.index');
// route to get the modal to  product sub details
// Route::get('products/{product}/modal', [FrontendController::class, 'showModal'])->name('dashboard.productmodal');
// routes/web.php
Route::get('/products/{product}/modal-data', 'FrontendController@getProductModalData')->name('front.product_modal_data');


//route to show all  active prodoct
Route::get('/shop', [FrontendController::class, 'viewShop'])->name('front.shop');

// route to show product details
Route::get('/products/{product}/productdetail', [FrontendController::class, 'showDetails'])->name('front.productdetail');

// view categories under the subcategory
Route::get('front_end/front/categories/{category}/categorypage', [FrontendController::class, 'viewCategory'])->name('front.categorypage');


// route to diplay the view  displays the products  under subcategories
Route::get('front_end/front/subcategories/{subcategory}/productpage', [FrontendController::class, 'viewProduct'])->name('front.productpage');


//ROUTE ON CART
//route to add to cart
// Route::get('add-to-cart/{id}', [FrontendController::class, 'addToCart'])->name('front.add_to_cart');
Route::post('add-to-cart/{id}', [FrontendController::class, 'addToCart'])->name('front.add_to_cart');


//route see the cart page
// Route::get('cart', [FrontendController::class, 'cart'])->name('front.cart')->middleware('web', 'auth');
//delete frome the cart
Route::delete('remove-from-cart', [FrontendController::class, 'remove'])->name('remove_from_cart');

//rout to updart the cart
// Route::patch('update-cart', [FrontendController::class, 'update'])->name('update_cart');
Route::patch('update-cart', [FrontendController::class, 'update'])->name('update_cart');


// Route::get('/', [CategoryController::class, 'viewMenu']);

// route to checkout:
// Route::post('/checkout', [FrontendController::class, 'checkout'])->name('front.checkout') ->middleware('auth');









// authentication of store admin
Route::post('/store/authenticate', [StoreController::class, 'authenticatestoremanager'])->name('store.loginstoremanager');



// login in  store manager
Route::get($store . '/login', [StoreController::class, 'storemanagerLogin'])->name('storemanager.login');


Route::prefix('/')->namespace('App\Http\Controllers\Store')->group(function () use ($store) {

    Route::group(['middleware' => ['store']], function () use ($store) {

        // route to  manage store manager page
        Route::get($store . '/managestore', [AdminController::class, 'showStoremanager'])->name('dashboard.storemanager');

        // log out admin route
        Route::post('/storemanager/logout', [StoreController::class, 'logoutStore'])->name('store.logout');
        //    route to see the order on the store manager dashboard
        Route::get($store, [OrderController::class, 'showStoreManageOrder'])->name('dashboard.manageorderstore');
        // route to see view the availabel orders by the store manager
        Route::get($store . '/orders', [OrderController::class, 'showStoreOrder'])->name('dashboard.orderstore');



        //ROUTE TO STORE MANAGEMENT SYSTEM
        // Route::get($store, [OrderController::class, 'showStoreManageOrder'])->name('dashboard.manageorderstore');

        //route selected for related items
        // Route::get('/orders/{order}/managerelatedorder', [OrderController::class, 'OrderRelated'])->name('dashboard.managerelatedorder');
        Route::get('/orders/managerelatedorder', [OrderController::class, 'OrderRelated'])->name('dashboard.managerelatedorder');


        // route to prepare goods for delivery
        Route::get('/orders/managepreparedorder', [OrderController::class, 'OrderPrepared'])->name('dashboard.managepreparedorder');

        // view order details
        Route::get('/orders/{order}/manageorderdetailstore', [OrderController::class, 'OrderDetailStore'])->name('dashboard.manageorderdetailstore');


        //SEt the order progress to be seen by the delivary man
        Route::put($store . '/dashboard/orders/{order}', [OrderController::class, 'updateOrderProgress'])->name('dashboard.updateorderprogress');

        //route to show store profile
        Route::get($store . '/dashboard/manageprofileadmin', [StoreController::class, 'showManageProfileStore'])->name('dashboard.manageprofilestore');

        // route  to change profile store
        Route::put($store . '/edit/store', [StoreController::class, 'updateStore'])->name('dashboard.updatestoreprofile');


        //    change password for the admin
        Route::post($store . '/dashboard/change_passwordstore', [StoreController::class, 'changePasswordStore'])->name('dashboard.changepassworstore');
    });
});





//ROUTE FOR PAYMENTS
//routes to show payments


//show the edit payments


// ROUTES FOR DELIVARY MAN
// Route::get($deliveryman, [DeliveryController::class, 'indexAlreadyOrder'])->name('dashboard.alreadyorder');


// route to the login  page of the delivary man
Route::get($deliveryman . '/login', [DeliveryController::class, 'DeliverymanLogin'])->name('deliveryman.login');

// route to authenticate  delivery man
Route::post('/deliveryman/authenticate', [DeliveryController::class, 'authenticateDeliveryMan'])->name('deliveryman.authenticate');

Route::prefix('/')->namespace('App\Http\Controllers\Deliveryman')->group(function () use ($deliveryman) {

    Route::group(['middleware' => ['deliveryman']], function () use ($deliveryman) {
        // route to show Dashboard of the deliveryman
        Route::get($deliveryman, [DeliveryController::class, 'indexDeliveryman'])->name('dashboard.deliveryman');

        Route::get($deliveryman . '/alreadyorders', [DeliveryController::class, 'AlreadyOrder'])->name('dashboard.alreadyorder');
        // route to for the delivary man to select from the orders which are prepared
        Route::post('/preparedorder', [OrderController::class, 'storePreparedorder'])->name('dashboard.ondeliveryorder');

        // route to get  delivaries attached to the  delivaryman
        Route::get($deliveryman . '/mydelivary', [DeliveryController::class, 'showMyDelivery'])->name('dashboard.mydelivary');

        // log out delivary route
        Route::post('/deliveryman/logout', [DeliveryController::class, 'logoutDeliveryman'])->name('deliveryman.logout');

        //route to show store profile
        Route::get($deliveryman . '/dashboard/manageprofiledeliveryman', [DeliveryController::class, 'showManageProfileDeliveryman'])->name('dashboard.manageprofiledeliveryman');
        // route to update profile
        Route::put($deliveryman . '/edit/deliveryman', [DeliveryController::class, 'updateDeliveryman'])->name('dashboard.updatedeliverymanprofile');


        //    change password for the admin
        Route::post($deliveryman . '/dashboard/change_passworddeliveryman', [DeliveryController::class, 'changePasswordDeliveryman'])->name('dashboard.changepasswordeliveryman');

        // route check the verrification code
        Route::post($deliveryman . '/check-verrificationcode', [DeliveryController::class, 'CheckVerificationCode']);

        //route to set it to be delivered
        Route::post($deliveryman . '/confirmdelivery', [DeliveryController::class, 'ConfirmDelivery'])->name('confirm.delivery');
        // Route to how deliveryman history
        Route::get($deliveryman . '/deliveryhistory', [DeliveryController::class, 'DeliveryHistory'])->name('history.delivery');
    });
});







// login in supperadmin
// Route::get($admin .'/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get($admin . '/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

// store admin
Route::post('/admin_users/authenticate', [AdminController::class, 'storeADmin'])->name('dashboard.authenticate');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers


// Route::post('/admin/authenticate', [AdminController::class, 'authenticateAdmin'])->name('dashboard.authenticatesadmin');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers

// Route::get($admin .'/dashboard', [AdminController::class, 'showAdminLogin'])->name('dashboard.loginadmin');


// Auth::routes();

Route::prefix('/')->namespace('App\Http\Controllers\Admin')->group(function () use ($admin) {

    Route::group(['middleware' => ['admin']], function () use ($admin) {


        //controller to register  a store manager
        Route::get($admin . '/storeregister', [AdminController::class, 'storemanagerRegisterpage'])->name('dashboard.storemanagerregister');

        //controller to go to register  a store manager
        Route::get($admin . '/storesupplier', [AdminController::class, 'supplierRegisterpage'])->name('dashboard.supplierregister');

        //create new users
        Route::post($admin . '/dashboard/registersupplier', [SupplierController::class, 'storeSupplier'])->name('dashboard.supplierregistering');
        // manage suppliers
        Route::get($admin . '/managesupplier', [SupplierController::class, 'showManagesupplier'])->name('dashboard.managesuppliers');


        // route to search in the admin panel
        Route::get('/search-admin', [AdminController::class, 'SearchAdmin'])->name('search_admin');
        Route::get($admin, [AdminController::class, 'indexDashboard'])->name('dashboard.index');
        // Route::get($admin . '/dashboard/managecatagory', [CategoryController::class, 'showManageCategory'])->name('dashboard.managecategory');

        // store the store manager
        Route::post($admin . '/dashboard/admin_users/registerstoremanager', [AdminController::class, 'storeStoreManager'])->name('admin_users.registerstoremanager');
        // route to delete  the store manager by admin
        Route::delete("$admin/dashboard/stores/{store}", [AdminController::class, 'deleteStore'])->name('dashboard.deletestore');


        // log out admin route
        Route::post('/admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');

        //ADMIN ROUTES STARTS HERE

        // route url to the admin dashbord
        // Route::get($admin, [AdminController::class, 'indexDashboard'])->name('dashboard.index');

        //route to show admin profile
        Route::get($admin . '/dashboard/manageprofileadmin', [AdminController::class, 'showManageProfileAdmin'])->name('dashboard.manageprofileadmin');
        // Route to edit the  profile of the admin
        Route::put($admin . '/edit/admin', [AdminController::class, 'updateAdmin'])->name('dashboard.updateadminprofile');



        //ROUTE FOR CATEGORY
        //route to show manage categories
        Route::get($admin . '/dashboard/managecatagory', [CategoryController::class, 'showManageCategory'])->name('dashboard.managecategory');

        //how the add page
        Route::get($admin . '/dashboard/addcategory', [CategoryController::class, 'showAddCategory'])->name('dashboard.addcategory');

        // store the category
        Route::post($admin . '/dashboard/addcategory', [CategoryController::class, 'storeCategory'])->name('dashboard.addcategory');


        // route to show   edit  category page
        // Route::get($admin.'/dashboard/categories/{id}/editcategory', [CategoryController::class, 'showEditCategory'])->name('dashboard.editcategory');

        Route::get($admin . '/dashboard/categories/{category}/editcategory', [CategoryController::class, 'showEditCategory'])->name('dashboard.editcategory');


        //route to update category
        Route::put($admin . '/dashboard/categories/{category}', [CategoryController::class, 'updateCategory'])->name('dashboard.updatecategory');

        // route delete category
        // Route::delete($admin.'/dashboard/categories/{category}', [CategoryController::class, 'deleteCategory'])->name('dashboard.deletecategory');
        Route::delete("$admin/dashboard/categories/{category}", [CategoryController::class, 'deleteCategory'])->name('dashboard.deletecategory');



        //ROUTE FOR SUBCATEGORY

        //route to show manage subcategories
        Route::get($admin . '/dashboard/managesubcatagory', [SubcategoryController::class, 'showManageSubcategory'])->name('dashboard.managesubcategory');

        //how the add page
        Route::get($admin . '/dashboard/addsubcategory', [SubcategoryController::class, 'showAddSubcategory'])->name('dashboard.addsubcategory');

        // store the subcategory
        Route::post($admin . '/dashboard/addsubcategory', [SubcategoryController::class, 'storeSubcategory'])->name('dashboard.addsubcategory');

        // route to show   edit  subcategory page
        Route::get($admin . '/dashboard/subcategories/{subcategory}/editcategory', [SubcategoryController::class, 'showEditSubcategory'])->name('dashboard.editsubcategory');

        //route to update subcategory
        Route::put($admin . '/dashboard/subcategories/{subcategory}', [SubcategoryController::class, 'updateSubcategory'])->name('dashboard.updatesubcategory');


        // route delete subcategory
        Route::delete("$admin/dashboard/subcategories/{subcategory}", [SubcategoryController::class, 'deleteSubcategory'])->name('dashboard.deletesubcategory');




        //ROUTE FOR PRODUCTS
        //route to show products
        Route::get($admin . '/dashboard/manageproduct', [ProductController::class, 'showManageProduct'])->name('dashboard.manageproduct');

        //show the add products
        Route::get($admin . '/dashboard/addproduct', [ProductController::class, 'showAddProduct'])->name('dashboard.addproduct');

        // store the Product
        Route::post($admin . '/dashboard/addproduct', [ProductController::class, 'storeProduct'])->name('dashboard.addproduct');

        // route to show   edit  products page
        Route::get($admin . '/dashboard/products/{product}/editproduct', [ProductController::class, 'showEditProduct'])->name('dashboard.editproduct');

        //route to update products
        Route::put($admin . '/dashboard/products/{product}', [ProductController::class, 'updateProduct'])->name('dashboard.updateproduct');

        // route delete products
        Route::delete("$admin/dashboard/products/{product}", [ProductController::class, 'deleteProduct'])->name('dashboard.deleteproduct');


        //ROUTE FOR PRODUCTS SIZE
        Route::get($admin . '/dashboard/manageproductsize', [ProductsizeController::class, 'showManageProductSize'])->name('dashboard.manageproductsize');

        //show the add products sizes
        Route::get($admin . '/dashboard/addproductsize', [ProductsizeController::class, 'showAddProductSize'])->name('dashboard.addproductsize');

        // store the Product
        Route::post($admin . '/dashboard/addproductsize', [ProductsizeController::class, 'storeProductSize'])->name('dashboard.addproductsize');

        // route to show   edit  products size
        Route::get($admin . '/dashboard/productsizes/{productsize}/editproductsize', [ProductsizeController::class, 'showEditProductSize'])->name('dashboard.editproductsize');

        //route to update products size
        Route::put($admin . '/dashboard/productsizes/{productsize}', [ProductsizeController::class, 'updateProductSize'])->name('dashboard.updateproductsize');

        // route delete products
        Route::delete("$admin/dashboard/productsizes/{productsize}", [ProductsizeController::class, 'deleteProductSize'])->name('dashboard.deleteproductsize');




        //ROUTE FOR PRODUCT GALLERY
        //route to show product gallery
        Route::get($admin . '/dashboard/manageproductgarallery', [ProductgalleryController::class, 'showManageProductGallery'])->name('dashboard.manageproductgarallery');


        //show the add products
        Route::get($admin . '/dashboard/addproductgarallery', [ProductgalleryController::class, 'showAddProductGallery'])->name('dashboard.addproductgarallery');

        // store the Product gallery
        Route::post($admin . '/dashboard/addproductgarallery', [ProductgalleryController::class, 'storeProductGallery'])->name('dashboard.addproductgarallery');

        // route to show   edit  products page
        Route::get($admin . '/dashboard/productgalleries/{productgallery}/editproductgallery', [ProductgalleryController::class, 'showEditProductGallery'])->name('dashboard.editproductgallery');

        //route to update category
        Route::put($admin . '/dashboard/productgalleries/{productgallery}', [ProductgalleryController::class, 'updateProductGallery'])->name('dashboard.updateproductgallery');

        // route delete category
        Route::delete("$admin/dashboard/productgalleries/{productgallery}", [ProductgalleryController::class, 'deleteProductGallery'])->name('dashboard.deleteproductgallery');




        //ROUTE FOR HOME ADVERTS
        //route to show Home adverts
        Route::get($admin . '/dashboard/managehomeadvert', [AdvertController::class, 'showManageHomeAdvert'])->name('dashboard.managehomeadvert');

        //show the add home Advert
        Route::get($admin . '/dashboard/addhomeadvert', [AdvertController::class, 'showAddHomeAdvert'])->name('dashboard.addhomeadvert');

        // store the  home Advert
        Route::post($admin . '/dashboard/addhomeadvert', [AdvertController::class, 'storeHomeAdvert'])->name('dashboard.addhomeadvert');

        // route to show   edit  home Advert page
        Route::get($admin . '/dashboard/adverts/{advert}/editadvert', [AdvertController::class, 'showEditSidvert'])->name('dashboard.editadvert');

        //route to update home Advert
        Route::put($admin . '/dashboard/adverts/{advert}', [AdvertController::class, 'updateAdvert'])->name('dashboard.updateadvert');

        // route delete home advert
        Route::delete("$admin/dashboard/adverts/{advert}", [AdvertController::class, 'deleteAdvert'])->name('dashboard.deleteadvert');





        //ROUTE FOR SIDE ADVERTS
        //route to show Home adverts
        Route::get($admin . '/dashboard/managesideadvert', [SideAdvertController::class, 'showManageSideAdvert'])->name('dashboard.managesideadvert');

        //show the add sideadvert
        Route::get($admin . '/dashboard/addsideadvert', [SideAdvertController::class, 'showAddSideAdvert'])->name('dashboard.addsideadvert');

        // store the  sideadvert
        Route::post($admin . '/dashboard/addsideadvert', [SideAdvertController::class, 'storeSideAdvert'])->name('dashboard.addsideadvert');
        // store the  sideadvert
        Route::post($admin . '/dashboard/addsideadvert', [SideAdvertController::class, 'storeSideAdvert'])->name('dashboard.addsideadvert');

        // route to show   edit  home Advert page
        Route::get($admin . '/dashboard/sideadverts/{sideadvert}/editsideadvert', [SideAdvertController::class, 'showEditSideadvert'])->name('dashboard.editsideadvert');

        //route to update sideadvert
        Route::put($admin . '/dashboard/sideadverts/{sideadvert}', [SideAdvertController::class, 'updateSideadvert'])->name('dashboard.updatesideadvert');

        // route delete home advert
        Route::delete("$admin/dashboard/sideadverts/{sideadvert}", [SideAdvertController::class, 'deleteSideAdvert'])->name('dashboard.deletesideadvert');







        //ROUTE FOR ORDER WITH CASH
        //routes to show order with cash
        Route::get($admin . '/dashboard/manageorderwithcash', [OrderWithCashController::class, 'showManageOrderWithCash'])->name('dashboard.manageorderwithcash');


        //show the edit order with cash



        //ROUTE FOR PAY ON DELIVERY
        //routes to show  pay on delivery
        Route::get($admin . '/dashboard/managepayondelivery', [PayOnDeliveryController::class, 'showManagePayOnDelivery'])->name('dashboard.managepayondelivery');


        //show the edit pay on delivary



        //ROUTE FOR DELIVERY
        //routes to show  delivery
        Route::get($admin . '/dashboard/managedelivery', [DeliveryController::class, 'showManageDelivery'])->name('dashboard.managedelivery');



        //ROUTE FOR DELIVERY MAN
        //routes to show  delivery man
        Route::get($admin . '/dashboard/managedeliveryman', [DeliverymanController::class, 'showManageDeliveryMan'])->name('dashboard.managedeliveryman');
        //route to delite delivery man
        Route::delete("$admin/dashboard/deliverymen/{deliveryman}", [DeliverymanController::class, 'deleteDeliveryman'])->name('dashboard.deletedeliveryman');

        //route to register are user
        Route::get($admin . '/dashboard/adddelivaryman', [DeliverymanController::class, 'showAddDelivaryMan'])->name('dashboard.adddelivaryman');


        //create new users
        Route::post($admin . '/dashboard/register', [DeliverymanController::class, 'storeDeliveryMan'])->name('dashboard.deliverymanregistering');


        //ROUTE FOR USER
        //show manage user
        Route::get($admin . '/dashboard/manageuser', [AdminController::class, 'showManageUser'])->name('dashboard.manageuser');



        //ROUTE FOR FEEDBACK
        //routes to show feedback
        Route::get($admin . '/dashboard/managefeedback', [FeedbackController::class, 'showManageFeedback'])->name('dashboard.managefeedback');

        //show the edit feedback
        //route to check current password
        Route::post($admin . '/check-current-password', [AdminController::class, 'CheckPasswordCurrent']);
        //route to change password of the admin
        Route::post($admin . '/dashboard/change_password', [AdminController::class, 'changePasswordAdmin'])->name('dashboard.changepasswordadmin');
        // route to ho profile of the admin
        // route::get($admin.'/profileadmin')




    });
});

//ROUTE FOR ORDERS
//routes to show orders
Route::get($admin . '/dashboard/manageorder', [OrderController::class, 'showManageOrder'])->name('dashboard.manageorder');

// store the  order
Route::post('/order', [OrderController::class, 'storeOrder'])->name('front.ordering');

// view order details
Route::get('/orders/{order}/manageorderdetail', [OrderController::class, 'OrderDetail'])->name('dashboard.manageorderdetail');



// END OF GROUP ROUTE FOR THE ADMIN


// CONTROLLER BY THE SUPPER ADMIN
// controller to authenticate admin

Route::post('/admin/authenticate', [AdminController::class, 'allowLoginAdmin'])->name('dashboard.allowloginadmin');

// controller to authenticate  the super admin

Route::post('/s_admin/authenticate', [SuperAdminController::class, 'authenticateSuperAdmin'])->name('dashboard.authenticatess_admin');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers


Route::get($s_admin . '/login', [SuperAdminController::class, 'showSuperAdminLogin'])->name('s_admin.login');
//
Route::prefix('/')->namespace('App\Http\Controllers\SuperAdmin')->group(function () use ($s_admin) {

    Route::group(['middleware' => ['superadmin']], function () use ($s_admin) {
        Route::get($s_admin, [SuperAdminController::class, 'showSuperAdmin'])->name('dash.index');
        // route to logout
        Route::post('/s_admin/logout', [SuperAdminController::class, 'logoutS_Admin'])->name('superadmin.logout');

        //
        // route to show   edit  ADmin
        Route::get($s_admin . '/dash/admins/{admin}/editadmin', [SuperAdminController::class, 'showEditADmin'])->name('dash.editadmin');

        //route to update sideadvert
        //   Route::put($s_admin . '/dash/admins/{admin}', [SuperAdminController::class, 'updateADmin'])->name('dashboard.updateadmin');

        // route delete admin
        Route::delete("$s_admin/dash/admins/{admin}", [SuperAdminController::class, 'deleteAdmin'])->name('dash.deleteadmin');


        // controller to store  the super admin
        Route::post('/admin_users/authenticate', [SuperAdminController::class, 'storesuperADmin'])->name('dashboard.storesuperadmin');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers
        //show the add sideadvert
        Route::get($s_admin . '/dash/addadmin', [SuperAdminController::class, 'showAddAdmin'])->name('dash.addadmin');
        // store the  admin
        Route::post('/admin/store', [SuperAdminController::class, 'storeADmin'])->name('dashboard.authenticate');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers

        //ROUTE  FOR  SUPPER ADMIN
        // route to dash dash board of supper admin
        // Route::get($s_admin, [SuperAdminController::class, 'showSuperAdmin'])->name('dash.index');

        // route to manage admin by supper admin
        Route::get($s_admin . '/dash/manageadmin', [SuperAdminController::class, 'showMangeAdmin'])->name('dash.manageadmin');

        // route  edit the admin by supper admin
        Route::get($s_admin . '/dash/addadmin', [SuperAdminController::class, 'showAddAdmin'])->name('dash.addadmin');



        // route to manage supper admin
        Route::get($s_admin . '/dash/manages_admin', [SuperAdminController::class, 'showMangeS_Admin'])->name('dash.manages_admin');

        // route  add the admin by supper admin
        Route::get($s_admin . '/dash/adds_admin', [SuperAdminController::class, 'showAddS_Admin'])->name('dash.adds_admin');

        // route to  create the supper admin account
        Route::post('/dash/registers_admin', [SuperAdminController::class, 'storeS_Admin'])->name('dash.registers_admin');
        // // login in supperadmin
        Route::get($s_admin . '/s_admin_users', [SuperAdminController::class, 'showS_AdminLogin'])->name('dash.logins_admin');

        // route to authenticate supper admin
        Route::post('/s_admin_users/authenticate', [SuperAdminController::class, 'authenticateS_Admin'])->name('dash.authenticates_admin');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers

        // route to logout
        Route::post('/logout', [SuperAdminController::class, 'logoutS_Admin'])->name('front.logout');

        //route to show superadmin profile
        Route::get($s_admin . '/dash/manageprofilesupperadmin', [SuperAdminController::class, 'showManageProfileS_admin'])->name('dashboard.manageprofiles_admin');

        //route to edit supper admin
        Route::put($s_admin . '/edit/superadmin', [SuperAdminController::class, 'updateSuperAdmin'])->name('dash.authenticateadmin');

        //    change password for the superadmin
        Route::post($s_admin . '/dashboard/change_passwordsuperadmin', [SuperAdminController::class, 'changePasswordSuperadmin'])->name('dash.changepasswordsuperadmin');
        // controller to eddit supper admin
        Route::post($s_admin . '/dashboard/change_passwordsuperadmin', [SuperAdminController::class, 'changePasswordSuperadmin'])->name('dash.changepasswordsuperadmin');

        // Route::put( $s_admin . '/edit/superadmin',[SuperAdminController::class,'updateSupperAdmin'])->name('dash.authenticateadmin');
        // Route::put($s_admin . '/edit/superadmin', [SuperAdminController::class, 'updateSuperAdmin'])->name('dash.authenticateadmin');

    });
});




// // route to show   edit  home Advert page
// Route::get($admin . '/dashboard/sideadverts/{sideadvert}/editsideadvert', [SideAdvertController::class, 'showEditSideadvert'])->name('dashboard.editsideadvert');

// //route to update sideadvert
// Route::put($admin . '/dashboard/sideadverts/{sideadvert}', [SideAdvertController::class, 'updateSideadvert'])->name('dashboard.updatesideadvert');

// // route delete home advert
// Route::delete("$admin/dashboard/sideadverts/{sideadvert}", [SideAdvertController::class, 'deleteSideAdvert'])->name('dashboard.deletesideadvert');

// route to login page on  supper
Route::get($supplier . '/login', [SupplierController::class, 'showSupplierLogin'])->name('supplier.login');

// authentication of store admin
Route::post('/supplier/authenticate', [SupplierController::class, 'authenticateSupplier'])->name('supplier.loginsupplier');



Route::prefix('/')->namespace('App\Http\Controllers\Supplier')->group(function () use ($supplier) {

    Route::group(['middleware' => ['supplier']], function () use ($supplier) {
        // route to see the suppliers dashboard
        Route::get($supplier, [SupplierController::class, 'showSupplierDashboard'])->name('dashboardsupplier.index');
        // route to logout the supplier
        Route::post('/supplier/logout', [SupplierController::class, 'logoutSupplier'])->name('supplier.logout');
        // controller to shows the the order that comes to the supplier
        Route::get($supplier . '/ordersavailable',[SupplierController::class,'showOrderSupplier'])->name('supplier.vieworders');
    });
});








Route::prefix('/')->namespace('App\Http\Controllers\SuperAdmin')->group(function () {

    Route::group(['middleware' => ['customer']], function () {
        // route to logout
        Route::post('/logout', [CustomerController::class, 'logoutUser'])->name('front.logout');
        // route to cart page
        Route::get('cart', [FrontendController::class, 'cart'])->name('front.cart');
        // route to checkout page
        Route::match(['get', 'post'], '/checkout', [FrontendController::class, 'checkout'])->name('front.checkout');
        // route to profile page of the user
        Route::get('/user-profile', [FrontendController::class, 'showUserProfile'])->name('front.customerprofile');
        // route to view orders by the customer
        Route::get('user-order', [FrontendController::class, 'userOrders'])->name('custemer.orders');
        //view order details by the customer
        // Route::get('user-orderdetails', [FrontendController::class, 'userOrdersdetails'])->name('custemer.ordersdetails');
        Route::get('/orders{order}/user-orderdetails', [FrontendController::class, 'viewuserOrdersdetails'])->name('customer.ordersdetails');

        // Route::get('/orders/{order}/manageorderdetailstore', [OrderController::class, 'OrderDetailStore'])->name('dashboard.manageorderdetailstore');





    });
});


// ROUTE TO MANAGE REGISTRATION
//search for products

Route::get('/products-search', [FrontendController::class, 'showsearchproductajax'])->name('front.productsearch');

// route to filter products
Route::get('/products-filter', [FrontendController::class, 'showsearchproduct'])->name('front.productfilter');


//route to register are user
Route::get('/register', [CustomerController::class, 'showRegister'])->name('front.register');

//create new users
Route::post('/users/register', [CustomerController::class, 'storeUser'])->name('front.registering');


//route to register are user
// Route::get('front_end/users/login',[UserController::class,'showLogin'])->name('login');
// Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/login', [CustomerController::class, 'showLogin'])->name('front.login');


// Route::get('/checkout', [FrontendController::class, 'checkout'])->name('front.checkout')->middleware('auth');


// Route::match(['get', 'post'], '/checkout', [FrontendController::class, 'checkout'])
//     ->name('front.checkout')
//     ->middleware('auth');


//logout route
// route::post('/logout', [UserController::class, 'logoutUser'])->name('front.logout')->middleware('web', 'auth');

//route to for authentification
Route::post('/users/authenticate', [CustomerController::class, 'authenticateUser'])->name('front.authenticate');  // methods authenticate,login,logout,login,store,create which are worked upon in controllers
