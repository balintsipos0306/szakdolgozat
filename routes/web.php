<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\webshopController;
use App\Http\Controllers\webshopLoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ViewController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'authenticate']);

Route::delete('/logout', [LoginController::class, 'destroy']);

Route::get('/login', function(){
    return view('Admin/login');
});

// Galéria

Route::get('/gallery/nature', [ViewController::class, 'galleryNature']);

Route::get('/gallery/portraits', [ViewController::class, 'galleryPortraits']);

Route::get('/gallery/events', [ViewController::class, 'galleryEvents']);

Route::get('/contact', function () {
    return view('contact');
});

// Blog

Route::get('/blog', [ViewController::class, 'blogIndex']);

Route::get('/blog/{id}', [ViewController::class, 'blogShow'])->name('blog.open');


// Email  / körlevél

Route::get('/newBlog-email', [MailController::class, 'newBlogToMail']);

Route::get('/subEmail', [MailController::class, 'Subscribe']);

Route::get('/regist', [MailController::class, 'newAcc']);


Route::get('/sub', [SubController::class, 'store']); //Regisztrációkor való hírlevélre feliratkozáskor használt

Route::post('/sub', [SubController::class, 'store']);


Route::get('/unSubscribe', function(Request $request){
    $email = $request->query('email');
    $name = $request->query('name');
    return view('unSubscribe')->with(['name' => $name, 'email' => $email]);
});

Route::post('/rm-sub', [SubController::class, 'delete'] );

Route::post('/mail', [MailController::class, 'sendMail']);

Route::post('/send-email-to-subs', [MailController::class, 'sendMailToSub']);

Route::get('/save-sent-newsletter', [NewsletterController::class, 'saveSentNewsletter']);


//Webshop

Route::get('/shop', [ViewController::class, 'webshopIndex']);

Route::get('/shop/item/{id}', [ViewController::class, 'webshopItemShow'])->name('item.open');

Route::get('/shop/order', [ViewController::class, 'webshopOrder']);

Route::post('/webshop/login', [webshopLoginController::class, 'authenticate']);
Route::delete('/webshop/logout', [webshopLoginController::class, 'destroy']);

Route::post('/webshop/registrate', [webshopController::class, 'registrate']);
Route::post('item-to-cart', [webshopController::class, 'addToCart']);
Route::post('delete-from-cart', [webshopController::class, 'deleteFromCart']);
Route::post('rm-acc', [webshopController::class, 'deleteAcc']);

//Admin oldal

Route::middleware('CustomAuth') -> group(function (){
    Route::get('/admin', function (){
        return view('Admin/adminView');
    });

    Route::get('/admin/image-upload', [ViewController::class, 'adminImageUpload']);

    Route::get('/admin/blog', function(){
        return view('Admin/blog-create');
    });
    
    Route::post('/upload', [GalleryController::class, 'store']);
    Route::post('/rm-image', [GalleryController::class, 'delete']);

    Route::post('/blog-upload', [BlogController::class, 'store']);
    Route::post('/blog-delete', [BlogController::class, 'delete']);
    Route::post('/blog-update', [BlogController::class, 'update']);


    Route::get('/blog/edit/{id}', [ViewController::class, 'adminBlogEdit'])->name('blog.edit');

    Route::get('/admin/webshop', [ViewController::class, 'adminWebshop']);

    Route::post('/webshop-upload', [webshopController::class, 'store']);
    Route::post('/webshop-delete', [webshopController::class, 'delete']);
    Route::post('/webshop-update', [webshopController::class, 'update']);
    
    Route::get('/admin/webshop/item/{id}', [ViewController::class, 'adminWebshopEdit'])->name('item.edit');
});