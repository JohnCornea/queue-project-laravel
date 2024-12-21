<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\TestJob;
use App\Jobs\DeleteUser;
use App\Jobs\UpdateUserLastLogin;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return 'Ionut';
});

Route::get('/', function () {
    
    $user = Auth::loginUsingId(6);

    if (Auth::check()){

        UpdateUserLastLogin::dispatch(Auth::user())->onConnection('database_backup')->onQueue('default');
        // TestJob::dispatch();
        DeleteUser::dispatch()->onConnection('database_backup2')->onQueue('custom');


        // UpdateUserLastLogin::dispatch(Auth::user())->onQueue('crazy');
        // TestJob::dispatch()->onQueue('custom');
        // DeleteUser::dispatch();
    }

    return 'User Job Dispatched 2';

});

Route::get('/testlogin', function () {

    $user = Auth::loginUsingId(6);

    if (Auth::check()){

        UpdateUserLastLogin::dispatch(Auth::user());
    }

    return 'User Job Dispatched';
});


Route::get('/job', function () {

    TestJob::dispatch();

    return 'Job dispatched';
});

Route::get('/delete', function () {

    DeleteUser::dispatch()->delay(now()->addMinute());

    return 'DeleteUser Job dispatched';
});
