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

Route::post('/login', [LoginController::class, 'authenticate']);
Route::delete('/logout', [LoginController::class, 'destroy']);

Route::post('/mail', [MailController::class, 'sendMail']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gallery/nature', function () {
    return view('Gallery/gallery');
});

Route::get('/gallery/portraits', function () {
    return view('Gallery/gallery_second');
});

Route::get('/gallery/events', function () {
    return view('Gallery/gallery_third');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', function(){
    return view('Admin/login');
});

Route::get('/blog', function(){
    return view('blog');
});

Route::get('/subEmail', [MailController::class, 'Subscribe']);
Route::get('/regist', [MailController::class, 'newAcc']);


Route::get('/sub', [SubController::class, 'store']); //Regisztrációkor való hírlevélre feliratkozáskor használt

Route::post('/sub', [SubController::class, 'store']);

Route::get('/blog/{id}', function($id) {
    return view('openedBlog', ['id' => $id]);
})->name('blog.open');

Route::get('/unSubscribe', function(Request $request){
    $email = $request->query('email');
    $name = $request->query('name');
    return view('unSubscribe')->with(['name' => $name, 'email' => $email]);
});

Route::post('/rm-sub', [SubController::class, 'delete'] );

Route::post('/send-email-to-subs', [MailController::class, 'sendMailToSub']);

Route::get('/newBlog-email', [MailController::class, 'newBlogToMail']);


//Webshop
Route::get('/shop', function(){
    return view("webshop");
});

Route::get('/shop/item/{id}', function($id) {
    return view('webshopItem', ['id' => $id]);
})->name('item.open');

Route::get('/shop/order', function(){
    return view('orderItem');
});

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

    Route::get('/admin/image-upload', function(){
        return view('Admin/imgupload');
    });

    Route::get('/admin/blog', function(){
        return view('Admin/blog-create');
    });
    
    Route::post('/upload', [GalleryController::class, 'store']);
    Route::post('/rm-image', [GalleryController::class, 'delete']);

    Route::post('/blog-upload', [BlogController::class, 'store']);
    Route::post('/blog-delete', [BlogController::class, 'delete']);
    Route::post('/blog-update', [BlogController::class, 'update']);


    Route::get('/blog/edit/{id}', function($id) {
        return view('Admin/blogEdit', ['id' => $id]);
    })->name('blog.edit');

    Route::get('/admin/webshop', function(){
        return view('Admin/adminWebshop');
    });

    Route::post('/webshop-upload', [webshopController::class, 'store']);
    Route::post('/webshop-delete', [webshopController::class, 'delete']);
    Route::post('/webshop-update', [webshopController::class, 'update']);

    Route::get('/admin/webshop/item/{id}', function($id) {
        return view('Admin/webshopEdit', ['id' => $id]);
    })->name('item.edit');
});