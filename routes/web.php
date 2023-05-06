<?php


\Illuminate\Support\Facades\Route::get('/', function (){
    return view('auth.login');
});


require __DIR__.'/admin/admin.php';
require __DIR__.'/user/user.php';
require __DIR__.'/client/client.php';
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('admin.index');
});
