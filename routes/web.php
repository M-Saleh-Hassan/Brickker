<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/change-lang/{lang}',array(
	  'as'=>'change-lang',
	  'uses'=>'LangController@changeLanguage'
	  ));
Route::get('/', function(){return redirect('/en/');});

/******************************************[English]******************************************/
/******************************************[English]******************************************/

Route::get('/test1',array(
	'as'=>'english.test',
	'uses'=>'english\HomeController@test'
));
Route::get('/en',array(
	'as'=>'en.home.index',
	'uses'=>'english\HomeController@index'
	));
Route::get('/about/en',array(
	'as'=>'en.about.index',
	'uses'=>'english\AboutController@index'
	));
Route::post('/search/en',array(
	'as'=>'en.home.search',
	'uses'=>'english\HomeController@search'
	));

/* Categories */
Route::get('/category/en',array(
	'as'=>'en.category.index',
	'uses'=>'english\CategoryController@index'
	));
Route::get('/category/all/en',array(
	'as'=>'en.category.show_all',
	'uses'=>'english\CategoryController@getAllProductsCategories'
	));
Route::post('/category/all/filter/en',array(
	'as'=>'en.category.products.filter',
	'uses'=>'english\CategoryController@filterProducts'
	));
Route::get('/category/{title_tag}/en',array(
	'as'=>'en.category.products',
	'uses'=>'english\CategoryController@getProducts'
	));
Route::get('/category/all/{title_tag}/en',array(
	'as'=>'en.category.all.products',
	'uses'=>'english\CategoryController@getAllProducts'
	));

/* Products */
Route::get('/product/{title_tag}/en',array(
	'as'=>'en.product.index',
	'uses'=>'english\ProductController@index'
	));
Route::post('/product/favorite/en',array(
	'as'=>'en.product.favorite',
	'uses'=>'english\ProductController@handleFavorite'
	));

/* Reviews */
Route::post('/product/{title_tag}/review/add/en',array(
	'as'=>'en.product.review.add',
	'uses'=>'english\ReviewController@openReviewModal'
	));
Route::post('/product/{title_tag}/review/save/en',array(
	'as'=>'en.product.review.save',
	'uses'=>'english\ReviewController@save'
	));
Route::post('/product/{title_tag}/review/helpful/en',array(
	'as'=>'en.product.review.helpful',
	'uses'=>'english\ReviewController@helpful'
	));
Route::post('/product/{title_tag}/review/nothelpful/en',array(
	'as'=>'en.product.review.nothelpful',
	'uses'=>'english\ReviewController@nothelpful'
	));


/* User Profile */
Route::get('/profile/{username_tag}/en',array(
	'as'=>'en.profile.index',
	'uses'=>'english\ProfileController@index',
	'middleware'=>'CheckForProfile'
	));
Route::get('/profile/{username_tag}/show/en',array(
	'as'=>'en.profile.show',
	'uses'=>'english\ProfileController@show',
	));
Route::post('/profile/{username_tag}/update/en',array(
	'as'=>'en.profile.update',
	'uses'=>'english\ProfileController@update'
	));
Route::post('/profile/{username_tag}/settype/en',array(
	'as'=>'en.profile.type',
	'uses'=>'english\ProfileController@settype'
	));
Route::post('/profile/changetype/en',array(
	'as'=>'en.profile.changeType',
	'uses'=>'english\ProfileController@changeType'
	));
Route::post('/profile/deactivate/en',array(
	'as'=>'en.profile.deactivate',
	'uses'=>'english\ProfileController@deactivate'
	));
Route::post('/profile/delete/en',array(
	'as'=>'en.profile.delete',
	'uses'=>'english\ProfileController@delete'
	));
Route::post('/profiles/filter/en',array(
	'as'=>'en.profiles.filter',
	'uses'=>'english\ProfileController@filter'
    ));

/* User Products */
Route::post('/profile/{username_tag}/product/save/en',array(
	'as'=>'en.profile.product.save',
	'uses'=>'english\ProductController@save'
	));
Route::get('/profile/{username_tag}/product/delete/{product_id}/en',array(
	'as'=>'en.profile.product.delete',
	'uses'=>'english\ProductController@delete'
	));
Route::post('/profile/{username_tag}/product/update/{product_id}/en',array(
	'as'=>'en.profile.product.update',
	'uses'=>'english\ProductController@update'
	));
Route::post('/profile/{username_tag}/product/filter/en',array(
	'as'=>'en.profile.product.filter',
	'uses'=>'english\ProductController@filter'
	));
Route::post('/profile/{username_tag}/product/quantity/main/filter/en',array(
	'as'=>'en.profile.product.quantity.main.filter',
	'uses'=>'english\ProductController@filterMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/main/filter/category/en',array(
	'as'=>'en.profile.product.quantity.main.filter.category',
	'uses'=>'english\ProductController@filterMainQuantityByCategory'
	));
Route::post('/profile/{username_tag}/product/quantity/main/choose/en',array(
	'as'=>'en.profile.product.quantity.main.choose',
	'uses'=>'english\ProductController@chooseMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/main/selected/en',array(
	'as'=>'en.profile.product.quantity.main.selected',
	'uses'=>'english\ProductController@selectedMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/main/all/en',array(
	'as'=>'en.profile.product.quantity.main.all',
	'uses'=>'english\ProductController@allMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/filter/en',array(
	'as'=>'en.profile.product.quantity.sub.filter',
	'uses'=>'english\ProductController@filterSubQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/filter/category/en',array(
	'as'=>'en.profile.product.quantity.sub.filter.category',
	'uses'=>'english\ProductController@filterSubQuantityByCategory'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/selected/en',array(
	'as'=>'en.profile.product.quantity.sub.selected',
	'uses'=>'english\ProductController@selectedSubQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/all/en',array(
	'as'=>'en.profile.product.quantity.sub.all',
	'uses'=>'english\ProductController@allSubQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/add/en',array(
	'as'=>'en.profile.product.quantity.add',
	'uses'=>'english\ProductController@addQuantity'
	));
Route::post('/profile/{username_tag}/product/image/delete/en',array(
	'as'=>'en.profile.product.image.delete',
	'uses'=>'english\ProductController@imageDelete'
	));

/* Scales */
Route::get('/scale/en',array(
	'as'=>'en.scale.index',
	'uses'=>'english\ScaleController@index',
	'middleware'=>'checkAuth'
	));
Route::get('/scale/{username_tag}/{scale_title}/{identifier}/en',array(
	'as'=>'en.scale.steps',
	'uses'=>'english\ScaleController@steps',
	'middleware'=>'CheckForProfile'
	));
Route::post('/scale/{username_tag}/get_steps/en',array(
	'as'=>'en.scale.getSteps',
	'uses'=>'english\ScaleController@getSteps'
	));
Route::post('/scale/step/products/en',array(
	'as'=>'en.scale.step.provider.products',
	'uses'=>'english\ScaleController@getStepProducts'
	));
Route::post('/scale/offer/en',array(
	'as'=>'en.scale.offer',
	'uses'=>'english\ScaleController@makeOffer'
	));
Route::post('/scale/offer/delete/en',array(
	'as'=>'en.scale.offer.delete',
	'uses'=>'english\ScaleController@deleteOffer'
	));
Route::post('/scale/offer/modal/en',array(
	'as'=>'en.scale.offer.modal',
	'uses'=>'english\ScaleController@getOfferModal'
	));

/* Projects */
Route::post('/project/{username_tag}/save/en',array(
    'as' => 'en.project.save',
    'uses' => 'english\ProjectController@save'
    ));
Route::post('/project/{username_tag}/update/en',array(
    'as' => 'en.project.update',
    'uses' => 'english\ProjectController@update'
    ));
Route::post('/project/{username_tag}/delete/en',array(
    'as' => 'en.project.delete',
    'uses' => 'english\ProjectController@delete'
    ));
Route::post('/project/{username_tag}/assign/en',array(
    'as' => 'en.project.assign',
    'uses' => 'english\ProjectController@assign'
    ));

/* Chat */
Route::get('/chat/en',array(
	'as'=>'en.chat.index',
	'uses'=>'english\ChatController@index',
	'middleware'=>'checkAuth'
	));
Route::post('/chat/send/en',array(
	'as'=>'en.chat.send',
	'uses'=>'english\ChatController@send'
	));

/* Checkout */
Route::get('/orders/{username_tag}/en',array(
	'as'=>'en.checkout.index',
	'uses'=>'english\CheckoutController@index',
	'middleware'=>'CheckForProfile'
	));
Route::post('/orders/add/{product_id}/{username_tag}/en',array(
	'as'=>'en.checkout.order.add',
	'uses'=>'english\CheckoutController@addToCart'
	));
Route::post('/orders/delete/en',array(
	'as'=>'en.checkout.order.delete',
	'uses'=>'english\CheckoutController@deleteOrder'
	));
Route::post('/orders/subscription/delete/en',array(
	'as'=>'en.checkout.subscription.delete',
	'uses'=>'english\CheckoutController@delete'
	));

/* Offers */
Route::get('/offers/{username_tag}/en',array(
	'as'=>'en.offer.index',
	'uses'=>'english\OfferController@index',
	'middleware'=>'CheckForProfile'
	));
Route::post('/offers/accept/en',array(
	'as'=>'en.offer.accept',
	'uses'=>'english\OfferController@accept'
	));
Route::post('/offers/reject/en',array(
	'as'=>'en.offer.reject',
	'uses'=>'english\OfferController@reject'
	));
Route::post('/offers/provider/deliver/en',array(
	'as'=>'en.offer.provider.deliver',
	'uses'=>'english\OfferController@providerDeliveryStatus'
	));

/* Policy  */
Route::get('/policy/en',array(
	'as'=>'en.policy.index',
	'uses'=>'english\PolicyController@index',
	));

/* Terms  */
Route::get('/term/en',array(
	'as'=>'en.term.index',
	'uses'=>'english\TermController@index',
	));

/* contact us  */
Route::get('/contactus/en',array(
	'as'=>'en.contactus.index',
	'uses'=>'english\ContactController@index',
	));
Route::post('/contactus/send/en',array(
	'as'=>'en.contactus.send',
	'uses'=>'english\ContactController@send',
	));

/* faq  */
Route::get('/faq/en',array(
	'as'=>'en.faq.index',
	'uses'=>'english\FaqController@index',
	));

/* Report Mistake */
Route::post('/report/send/en',array(
	'as'=>'en.report.send',
	'uses'=>'english\ReportController@send'
	));

/* How to work */
Route::get('/howtowork/en',array(
	'as'=>'en.howtowork.index',
	'uses'=>'english\HowtoworkController@index'
	));


/* Notifications */
Route::post('/notification/clear/en',array(
	'as'=>'en.notification.clear',
	'uses'=>'english\NotificationController@clear'
	));

/* Confirmation */
Route::get('/email/verify/{verified_token}/en',array(
	'as'=>'en.email.verify',
	'uses'=>'english\Authentication\AuthController@verify'
	));

/******************************************[Arabic]******************************************/
/******************************************[Arabic]******************************************/
Route::get('/test1',array(
	'as'=>'arabic.test',
	'uses'=>'arabic\HomeController@test'
));
Route::get('/ar',array(
	'as'=>'ar.home.index',
	'uses'=>'arabic\HomeController@index'
	));
Route::get('/about/ar',array(
	'as'=>'ar.about.index',
	'uses'=>'arabic\AboutController@index'
	));
Route::post('/search/ar',array(
	'as'=>'ar.home.search',
	'uses'=>'arabic\HomeController@search'
	));

/* Categories */
Route::get('/category/ar',array(
	'as'=>'ar.category.index',
	'uses'=>'arabic\CategoryController@index'
	));
Route::get('/category/all/ar',array(
	'as'=>'ar.category.show_all',
	'uses'=>'arabic\CategoryController@getAllProductsCategories'
	));
Route::post('/category/all/filter/ar',array(
	'as'=>'ar.category.products.filter',
	'uses'=>'arabic\CategoryController@filterProducts'
	));
Route::get('/category/{title_tag}/ar',array(
	'as'=>'ar.category.products',
	'uses'=>'arabic\CategoryController@getProducts'
	));
Route::get('/category/all/{title_tag}/ar',array(
	'as'=>'ar.category.all.products',
	'uses'=>'arabic\CategoryController@getAllProducts'
	));

/* Products */
Route::get('/product/{title_tag}/ar',array(
	'as'=>'ar.product.index',
	'uses'=>'arabic\ProductController@index'
	));
Route::post('/product/favorite/ar',array(
	'as'=>'ar.product.favorite',
	'uses'=>'arabic\ProductController@handleFavorite'
	));

/* Reviews */
Route::post('/product/{title_tag}/review/add/ar',array(
	'as'=>'ar.product.review.add',
	'uses'=>'arabic\ReviewController@openReviewModal'
	));
Route::post('/product/{title_tag}/review/save/ar',array(
	'as'=>'ar.product.review.save',
	'uses'=>'arabic\ReviewController@save'
	));
Route::post('/product/{title_tag}/review/helpful/ar',array(
	'as'=>'ar.product.review.helpful',
	'uses'=>'arabic\ReviewController@helpful'
	));
Route::post('/product/{title_tag}/review/nothelpful/ar',array(
	'as'=>'ar.product.review.nothelpful',
	'uses'=>'arabic\ReviewController@nothelpful'
	));


/* User Profile */
Route::get('/profile/{username_tag}/ar',array(
	'as'=>'ar.profile.index',
	'uses'=>'arabic\ProfileController@index',
	'middleware'=>'CheckForProfile'
	));
Route::get('/profile/{username_tag}/show/ar',array(
	'as'=>'ar.profile.show',
	'uses'=>'arabic\ProfileController@show',
	));
Route::post('/profile/{username_tag}/update/ar',array(
	'as'=>'ar.profile.update',
	'uses'=>'arabic\ProfileController@update'
	));
Route::post('/profile/{username_tag}/settype/ar',array(
	'as'=>'ar.profile.type',
	'uses'=>'arabic\ProfileController@settype'
	));
Route::post('/profile/changetype/ar',array(
	'as'=>'ar.profile.changeType',
	'uses'=>'arabic\ProfileController@changeType'
	));
Route::post('/profile/deactivate/ar',array(
	'as'=>'ar.profile.deactivate',
	'uses'=>'arabic\ProfileController@deactivate'
	));
Route::post('/profile/delete/ar',array(
	'as'=>'ar.profile.delete',
	'uses'=>'arabic\ProfileController@delete'
	));

Route::post('/profiles/filter/ar',array(
	'as'=>'ar.profiles.filter',
	'uses'=>'arabic\ProfileController@filter'
    ));

/* User Products */
Route::post('/profile/{username_tag}/product/save/ar',array(
	'as'=>'ar.profile.product.save',
	'uses'=>'arabic\ProductController@save'
	));
Route::get('/profile/{username_tag}/product/delete/{product_id}/ar',array(
	'as'=>'ar.profile.product.delete',
	'uses'=>'arabic\ProductController@delete'
	));
Route::post('/profile/{username_tag}/product/update/{product_id}/ar',array(
	'as'=>'ar.profile.product.update',
	'uses'=>'arabic\ProductController@update'
	));
Route::post('/profile/{username_tag}/product/filter/ar',array(
	'as'=>'ar.profile.product.filter',
	'uses'=>'arabic\ProductController@filter'
	));
Route::post('/profile/{username_tag}/product/quantity/main/filter/ar',array(
	'as'=>'ar.profile.product.quantity.main.filter',
	'uses'=>'arabic\ProductController@filterMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/main/filter/category/ar',array(
	'as'=>'ar.profile.product.quantity.main.filter.category',
	'uses'=>'arabic\ProductController@filterMainQuantityByCategory'
	));
Route::post('/profile/{username_tag}/product/quantity/main/choose/ar',array(
	'as'=>'ar.profile.product.quantity.main.choose',
	'uses'=>'arabic\ProductController@chooseMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/main/selected/ar',array(
	'as'=>'ar.profile.product.quantity.main.selected',
	'uses'=>'arabic\ProductController@selectedMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/main/all/ar',array(
	'as'=>'ar.profile.product.quantity.main.all',
	'uses'=>'arabic\ProductController@allMainQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/filter/ar',array(
	'as'=>'ar.profile.product.quantity.sub.filter',
	'uses'=>'arabic\ProductController@filterSubQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/filter/category/ar',array(
	'as'=>'ar.profile.product.quantity.sub.filter.category',
	'uses'=>'arabic\ProductController@filterSubQuantityByCategory'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/selected/ar',array(
	'as'=>'ar.profile.product.quantity.sub.selected',
	'uses'=>'arabic\ProductController@selectedSubQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/sub/all/ar',array(
	'as'=>'ar.profile.product.quantity.sub.all',
	'uses'=>'arabic\ProductController@allSubQuantity'
	));
Route::post('/profile/{username_tag}/product/quantity/add/ar',array(
	'as'=>'ar.profile.product.quantity.add',
	'uses'=>'arabic\ProductController@addQuantity'
	));
Route::post('/profile/{username_tag}/product/image/delete/ar',array(
	'as'=>'ar.profile.product.image.delete',
	'uses'=>'arabic\ProductController@imageDelete'
	));

/* Scales */
Route::get('/scale/ar',array(
	'as'=>'ar.scale.index',
	'uses'=>'arabic\ScaleController@index',
	'middleware'=>'checkAuth'
	));
Route::get('/scale/{username_tag}/{scale_title}/{identifier}/ar',array(
	'as'=>'ar.scale.steps',
	'uses'=>'arabic\ScaleController@steps',
	'middleware'=>'CheckForProfile'
	));
Route::post('/scale/{username_tag}/get_steps/ar',array(
	'as'=>'ar.scale.getSteps',
	'uses'=>'arabic\ScaleController@getSteps'
	));
Route::post('/scale/step/products/ar',array(
	'as'=>'ar.scale.step.provider.products',
	'uses'=>'arabic\ScaleController@getStepProducts'
	));
Route::post('/scale/offer/ar',array(
	'as'=>'ar.scale.offer',
	'uses'=>'arabic\ScaleController@makeOffer'
	));
Route::post('/scale/offer/delete/ar',array(
	'as'=>'ar.scale.offer.delete',
	'uses'=>'arabic\ScaleController@deleteOffer'
	));
Route::post('/scale/offer/modal/ar',array(
	'as'=>'ar.scale.offer.modal',
	'uses'=>'arabic\ScaleController@getOfferModal'
	));

/* Projects */
Route::post('/project/{username_tag}/save/ar',array(
    'as' => 'ar.project.save',
    'uses' => 'arabic\ProjectController@save'
    ));
Route::post('/project/{username_tag}/update/ar',array(
    'as' => 'ar.project.update',
    'uses' => 'arabic\ProjectController@update'
    ));
Route::post('/project/{username_tag}/delete/ar',array(
    'as' => 'ar.project.delete',
    'uses' => 'arabic\ProjectController@delete'
    ));
Route::post('/project/{username_tag}/assign/ar',array(
    'as' => 'ar.project.assign',
    'uses' => 'arabic\ProjectController@assign'
    ));

/* Chat */
Route::get('/chat/ar',array(
	'as'=>'ar.chat.index',
	'uses'=>'arabic\ChatController@index',
	'middleware'=>'checkAuth'
	));
Route::post('/chat/send/ar',array(
	'as'=>'ar.chat.send',
	'uses'=>'arabic\ChatController@send'
	));

/* Checkout */
Route::get('/orders/{username_tag}/ar',array(
	'as'=>'ar.checkout.index',
	'uses'=>'arabic\CheckoutController@index',
	'middleware'=>'CheckForProfile'
	));
Route::post('/orders/add/{product_id}/{username_tag}/ar',array(
	'as'=>'ar.checkout.order.add',
	'uses'=>'arabic\CheckoutController@addToCart'
	));
Route::post('/orders/delete/ar',array(
	'as'=>'ar.checkout.order.delete',
	'uses'=>'arabic\CheckoutController@deleteOrder'
	));
Route::post('/orders/subscription/delete/ar',array(
	'as'=>'ar.checkout.subscription.delete',
	'uses'=>'arabic\CheckoutController@delete'
	));

/* Offers */
Route::get('/offers/{username_tag}/ar',array(
	'as'=>'ar.offer.index',
	'uses'=>'arabic\OfferController@index',
	'middleware'=>'CheckForProfile'
	));
Route::post('/offers/accept/ar',array(
	'as'=>'ar.offer.accept',
	'uses'=>'arabic\OfferController@accept'
	));
Route::post('/offers/reject/ar',array(
	'as'=>'ar.offer.reject',
	'uses'=>'arabic\OfferController@reject'
	));
Route::post('/offers/provider/deliver/ar',array(
	'as'=>'ar.offer.provider.deliver',
	'uses'=>'arabic\OfferController@providerDeliveryStatus'
	));

/* Policy  */
Route::get('/policy/ar',array(
	'as'=>'ar.policy.index',
	'uses'=>'arabic\PolicyController@index',
    ));

/* Terms   */
Route::get('/term/ar',array(
	'as'=>'ar.term.index',
	'uses'=>'arabic\TermController@index',
	));

/* contact us  */
Route::get('/contactus/ar',array(
	'as'=>'ar.contactus.index',
	'uses'=>'arabic\ContactController@index',
	));
Route::post('/contactus/send/ar',array(
	'as'=>'ar.contactus.send',
	'uses'=>'arabic\ContactController@send',
	));

/* faq  */
Route::get('/faq/ar',array(
	'as'=>'ar.faq.index',
	'uses'=>'arabic\FaqController@index',
	));

/* Report Mistake */
Route::post('/report/send/ar',array(
	'as'=>'ar.report.send',
	'uses'=>'arabic\ReportController@send'
	));

/* How to work */
Route::get('/howtowork/ar',array(
	'as'=>'ar.howtowork.index',
	'uses'=>'arabic\HowtoworkController@index'
	));

/* Notifications */
Route::post('/notification/clear/ar',array(
	'as'=>'ar.notification.clear',
	'uses'=>'arabic\NotificationController@clear'
	));

Route::get('/phpfirebase', 'FirebaseController@index');
Route::get('/test', 'TestController@index');
// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'english\Authentication\AuthController@signIn')->name('signIn');
Route::post('logout', 'english\Authentication\AuthController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'english\Authentication\AuthController@signUp')->name('register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/home', 'HomeController@index')->name('index');
Route::get('/upload_test', 'UploadController@uploadForm');
Route::post('/upload_test', 'UploadController@uploadSubmit');
Route::post('/product', 'UploadController@postProduct');


/******************************************[Admin]******************************************/
/******************************************[Admin]******************************************/

Route::group(['middleware' => ['checkAuth']], function ()
{

	Route::group(['middleware' => ['checkAdmin']], function ()
	{
        Route::prefix('cpannel/code618bcb3128653079c2bed313513583dd')->group(function ()
        {
            // Route::get('/admin/panel', 'AdminController@index')->name('panel.index');
		    Route::get('/',array(
		          'as'=>'admin.home.index',
		          'uses'=>'Admin\AdminController@index'
                  ));

            //Profile
            Route::get('/profile',array(
		          'as'=>'admin.profile.edit',
		          'uses'=>'Admin\ProfileController@edit'
                  ));
            Route::post('/profile/update',array(
		          'as'=>'admin.profile.update',
		          'uses'=>'Admin\ProfileController@update'
                  ));

            //Users
            Route::get('/users',array(
		          'as'=>'admin.users',
		          'uses'=>'Admin\UserController@index'
		          ));
            Route::get('/users/{id}',array(
		          'as'=>'admin.users.edit',
		          'uses'=>'Admin\UserController@edit'
		          ));
            Route::post('/users/{id}/update',array(
		          'as'=>'admin.users.update',
		          'uses'=>'Admin\UserController@update'
		          ));
            Route::post('/users/delete',array(
				  'as'=>'admin.users.delete',
				  'uses'=>'Admin\UserController@delete'
				  ));

            //Users Types
            Route::get('/user/types',array(
		          'as'=>'admin.users.types',
		          'uses'=>'Admin\UserController@getAllTypes'
		          ));
            Route::get('/users/types/{id}',array(
		          'as'=>'admin.users.types.edit',
		          'uses'=>'Admin\UserController@typeEdit'
		          ));
            Route::post('/users/types/{id}/update',array(
		          'as'=>'admin.users.types.update',
		          'uses'=>'Admin\UserController@typeUpdate'
		          ));
            Route::post('/users/types/add',array(
				  'as'=>'admin.users.types.add',
				  'uses'=>'Admin\UserController@typeAdd'
				  ));
            Route::post('/users/types/delete',array(
				  'as'=>'admin.users.types.delete',
				  'uses'=>'Admin\UserController@typeDelete'
				  ));

            //Products
            Route::get('/products',array(
		          'as'=>'admin.products.index',
		          'uses'=>'Admin\ProductController@index'
		          ));
            Route::get('/products/{id}',array(
		          'as'=>'admin.products.edit',
		          'uses'=>'Admin\ProductController@edit'
		          ));
            Route::post('/products/{id}/update',array(
		          'as'=>'admin.products.update',
		          'uses'=>'Admin\ProductController@update'
		          ));
            Route::post('/products/delete',array(
				  'as'=>'admin.products.delete',
				  'uses'=>'Admin\ProductController@delete'
				  ));
			Route::post('/products/featured',array(
				'as'=>'admin.products.featured',
				'uses'=>'Admin\ProductController@makeFeatured'
				));
			Route::post('/products/notfeatured',array(
				'as'=>'admin.products.notfeatured',
				'uses'=>'Admin\ProductController@makeNotFeatured'
				));


		    //Scales
            Route::get('/scales',array(
                'as'=>'admin.scale.index',
                'uses'=>'Admin\ScaleController@index'
            ));
            Route::get('/scales/{id}',array(
				'as'=>'admin.scale.edit',
				'uses'=>'Admin\ScaleController@edit'
			));
        	Route::post('/scales/add',array(
    			'as'=>'admin.scale.add',
    			'uses'=>'Admin\ScaleController@add'
			));
			Route::post('/scales/{id}/update',array(
				'as'=>'admin.scale.update',
				'uses'=>'Admin\ScaleController@update'
			));
			Route::post('/scales/delete',array(
    			'as'=>'admin.scale.delete',
    			'uses'=>'Admin\ScaleController@delete'
			));

		    //Steps
            Route::get('/steps',array(
                'as'=>'admin.step.index',
                'uses'=>'Admin\StepController@index'
            ));
            Route::get('/steps/{id}',array(
				'as'=>'admin.step.edit',
				'uses'=>'Admin\StepController@edit'
			));
        	Route::post('/steps/add',array(
    			'as'=>'admin.step.add',
    			'uses'=>'Admin\StepController@add'
			));
			Route::post('/steps/{id}/update',array(
				'as'=>'admin.step.update',
				'uses'=>'Admin\StepController@update'
			));
			Route::post('/steps/delete',array(
    			'as'=>'admin.step.delete',
    			'uses'=>'Admin\StepController@delete'
			));



            //Media
		    Route::get('/media',array(
		          'as'=>'admin.media.index',
		          'uses'=>'Admin\MediaController@index'
		          ));
		    Route::post('/media_upload',array(
		          'as'=>'admin.media.upload',
		          'uses'=>'Admin\MediaController@uploadSubmit'
		          ));
		    Route::post('/media_delete',array(
		          'as'=>'admin.media.delete',
		          'uses'=>'Admin\MediaController@deleteFile'
		          ));

			//Categories
			Route::get('/categories',array(
				'as'=>'admin.categories.index',
				'uses'=>'Admin\CategoryController@index'
				));
			Route::get('/categories/{id}',array(
				'as'=>'admin.categories.edit',
				'uses'=>'Admin\CategoryController@edit'
				));
			Route::post('/categories/{id}/update',array(
				'as'=>'admin.categories.update',
				'uses'=>'Admin\CategoryController@update'
				));
			Route::get('/categories/children/{id}',array(
				'as'=>'admin.categories.sub_categories',
				'uses'=>'Admin\CategoryController@showSubCategories'
				));
			Route::post('/categories_add',array(
				'as'=>'admin.categories.add',
				'uses'=>'Admin\CategoryController@add'
				));
			// Route::post('/categories_sub',array(
			// 	'as'=>'admin.categories.sub',
			// 	'uses'=>'Admin\CategoryController@getSubCategories'
			// 	));
			Route::post('/categories_delete',array(
				'as'=>'admin.categories.delete',
				'uses'=>'Admin\CategoryController@delete'
				));

	        /* Units */
	        Route::get('/units',array(
				'as'=>'admin.units.index',
				'uses'=>'Admin\UnitController@index'
				));
			Route::get('/units/edit/{id}',array(
				'as'=>'admin.units.edit',
				'uses'=>'Admin\UnitController@edit'
				));
			Route::post('/units/update/{id}',array(
				'as'=>'admin.units.update',
				'uses'=>'Admin\UnitController@update'
				));
			Route::post('/units/add',array(
				'as'=>'admin.units.add',
				'uses'=>'Admin\UnitController@add'
				));
			Route::post('/units/delete',array(
				'as'=>'admin.units.delete',
				'uses'=>'Admin\UnitController@delete'
				));

	        /* Quantities */
	        Route::get('/quantities',array(
				'as'=>'admin.quantities.index',
				'uses'=>'Admin\QuantityController@index'
				));
			Route::post('/quantities/approve',array(
				'as'=>'admin.quantities.approve',
				'uses'=>'Admin\QuantityController@approve'
				));
			Route::post('/quantities/disapprove',array(
				'as'=>'admin.quantities.disapprove',
				'uses'=>'Admin\QuantityController@disapprove'
				));
			Route::get('/quantities/edit/{id}',array(
				'as'=>'admin.quantities.edit',
				'uses'=>'Admin\QuantityController@edit'
				));
			Route::post('/quantities/update/{id}',array(
				'as'=>'admin.quantities.update',
				'uses'=>'Admin\QuantityController@update'
				));
			Route::post('/quantities/add',array(
				'as'=>'admin.quantities.add',
				'uses'=>'Admin\QuantityController@add'
				));
			Route::post('/quantities/delete',array(
				'as'=>'admin.quantities.delete',
				'uses'=>'Admin\QuantityController@delete'
				));

			/* Home Slider */
			Route::get('/slider',array(
				'as'=>'admin.slider.index',
				'uses'=>'Admin\SliderController@index'
				));
			Route::get('/slider/edit/{id}',array(
				'as'=>'admin.slider.edit',
				'uses'=>'Admin\SliderController@edit'
				));
			Route::post('/slider/update/{id}',array(
				'as'=>'admin.slider.update',
				'uses'=>'Admin\SliderController@update'
				));
			Route::post('/slider/add',array(
				'as'=>'admin.slider.add',
				'uses'=>'Admin\SliderController@add'
				));
			Route::post('/slider/delete',array(
				'as'=>'admin.slider.delete',
				'uses'=>'Admin\SliderController@delete'
				));

			/* Settings */
			Route::get('/settings',array(
				'as'=>'admin.settings.index',
				'uses'=>'Admin\SettingsController@index'
				));
			Route::post('/settings/update/{id}',array(
				'as'=>'admin.settings.update',
				'uses'=>'Admin\SettingsController@update'
				));

			/* About */
			Route::get('/about',array(
				'as'=>'admin.about.index',
				'uses'=>'Admin\AboutController@index'
				));
			Route::post('/about/vision',array(
				'as'=>'admin.about.vision',
				'uses'=>'Admin\AboutController@vision'
				));
			Route::post('/about/mission',array(
				'as'=>'admin.about.mission',
				'uses'=>'Admin\AboutController@mission'
				));
			Route::post('/about/why_us',array(
				'as'=>'admin.about.why_us',
				'uses'=>'Admin\AboutController@why_us'
				));

            /* Policy */
			Route::get('/policy',array(
				'as'=>'admin.policy.index',
				'uses'=>'Admin\PolicyController@index'
				));
			Route::post('/policy/update',array(
				'as'=>'admin.policy.update',
				'uses'=>'Admin\PolicyController@update'
				));

            /* Terms of Service */
			Route::get('/term',array(
				'as'=>'admin.term.index',
				'uses'=>'Admin\TermController@index'
				));
			Route::post('/term/update',array(
				'as'=>'admin.term.update',
				'uses'=>'Admin\TermController@update'
				));

            /* Faq */
			Route::get('/faqs',array(
				'as'=>'admin.faqs.index',
				'uses'=>'Admin\FaqController@index'
				));
			Route::get('/faqs/edit/{id}',array(
				'as'=>'admin.faqs.edit',
				'uses'=>'Admin\FaqController@edit'
				));
			Route::post('/faqs/update/{id}',array(
				'as'=>'admin.faqs.update',
				'uses'=>'Admin\FaqController@update'
				));
			Route::post('/faqs/add',array(
				'as'=>'admin.faqs.add',
				'uses'=>'Admin\FaqController@add'
				));
			Route::post('/faqs/delete',array(
				'as'=>'admin.faqs.delete',
				'uses'=>'Admin\FaqController@delete'
				));

		/* Howtowork */
			Route::get('/howtowork',array(
				'as'=>'admin.howtowork.index',
				'uses'=>'Admin\HowtoworkController@index'
				));
			Route::get('/howtowork/edit/{id}',array(
				'as'=>'admin.howtowork.edit',
				'uses'=>'Admin\HowtoworkController@edit'
				));
			Route::post('/howtowork/update/{id}',array(
				'as'=>'admin.howtowork.update',
				'uses'=>'Admin\HowtoworkController@update'
				));
			Route::post('/howtowork/add',array(
				'as'=>'admin.howtowork.add',
				'uses'=>'Admin\HowtoworkController@add'
				));
			Route::post('/howtowork/delete',array(
				'as'=>'admin.howtowork.delete',
				'uses'=>'Admin\HowtoworkController@delete'
				));

            /* Contact Us */
			Route::get('/contact_us',array(
				'as'=>'admin.contact_us.index',
				'uses'=>'Admin\ContactController@index'
				));
			Route::post('/contact_us/text',array(
				'as'=>'admin.contact_us.text',
				'uses'=>'Admin\ContactController@text'
				));
			Route::post('/contact_us/update/{id}',array(
				'as'=>'admin.contact_us.update',
				'uses'=>'Admin\ContactController@update'
				));
			Route::post('/contact_us/delete',array(
				'as'=>'admin.contact_us.delete',
				'uses'=>'Admin\ContactController@delete'
				));

            /* Reports */
			Route::get('/report',array(
				'as'=>'admin.reports.index',
				'uses'=>'Admin\ReportController@index'
				));
			Route::post('/report/update/{id}',array(
				'as'=>'admin.reports.update',
				'uses'=>'Admin\ReportController@update'
				));
			Route::post('/report/delete',array(
				'as'=>'admin.reports.delete',
				'uses'=>'Admin\ReportController@delete'
				));

            /* Currencies */
	        Route::get('/currencies',array(
				'as'=>'admin.currencies.index',
				'uses'=>'Admin\CurrencyController@index'
				));
			Route::get('/currencies/edit/{id}',array(
				'as'=>'admin.currencies.edit',
				'uses'=>'Admin\CurrencyController@edit'
				));
			Route::post('/currencies/update/{id}',array(
				'as'=>'admin.currencies.update',
				'uses'=>'Admin\CurrencyController@update'
				));
			Route::post('/currencies/add',array(
				'as'=>'admin.currencies.add',
				'uses'=>'Admin\CurrencyController@add'
				));
			Route::post('/currencies/delete',array(
				'as'=>'admin.currencies.delete',
				'uses'=>'Admin\CurrencyController@delete'
				));
			Route::post('/currencies/active',array(
				'as'=>'admin.currencies.active',
				'uses'=>'Admin\CurrencyController@active'
				));
			Route::post('/currencies/deactive',array(
				'as'=>'admin.currencies.deactive',
				'uses'=>'Admin\CurrencyController@deactive'
				));

            /* Countries */
	        Route::get('/countries',array(
				'as'=>'admin.countries.index',
				'uses'=>'Admin\CountryController@index'
				));
			Route::get('/countries/edit/{id}',array(
				'as'=>'admin.countries.edit',
				'uses'=>'Admin\CountryController@edit'
				));
			Route::post('/countries/update/{id}',array(
				'as'=>'admin.countries.update',
				'uses'=>'Admin\CountryController@update'
				));
			Route::post('/countries/add',array(
				'as'=>'admin.countries.add',
				'uses'=>'Admin\CountryController@add'
				));
			Route::post('/countries/delete',array(
				'as'=>'admin.countries.delete',
				'uses'=>'Admin\CountryController@delete'
				));

			/* Advertisements */
			Route::get('/ads',array(
				'as'=>'admin.ads.index',
				'uses'=>'Admin\AdvertisementController@index'
				));
			Route::get('/ads/edit/{id}',array(
				'as'=>'admin.ads.product.edit',
				'uses'=>'Admin\AdvertisementController@editProduct'
				));
			Route::post('/ads/update/{id}',array(
				'as'=>'admin.ads.product.update',
				'uses'=>'Admin\AdvertisementController@updateProduct'
				));
			Route::post('/ads/add',array(
				'as'=>'admin.ads.product.add',
				'uses'=>'Admin\AdvertisementController@addProduct'
				));
			Route::post('/ads/delete',array(
				'as'=>'admin.ads.product.delete',
				'uses'=>'Admin\AdvertisementController@deleteProduct'
				));
		});
	});

});
