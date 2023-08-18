<?php

use App\Models\Post;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app');
});

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.password-reset', [
        'token' => $token
    ]);
})->middleware(['guest:' . config('fortify.guard')])
    ->name('password.reset');

Route::get('/shared/posts/{post}', function (\Illuminate\Http\Request $request, Post $post) {

    return "Specially made just for you 💕 ;) Post id: {$post->id}";

})->name('shared.post')->middleware('signed');



if (\Illuminate\Support\Facades\App::environment('local')) {

    Route::get('/playground', function () {
        $user = User::factory()->create();
        Mail::to($user)->send(new WelcomeMail($user));
        return 'sent';
        // return (
        //     new WelcomeMail(
        //         User::factory()->create()
        //     )
        // )->render();
    });

    //    Route::get('/shared/videos/{video}', function (\Illuminate\Http\Request $request, $video){
    //
    ////        if(!$request->hasValidSignature()){
    ////            abort(401);
    ////        }
    //
    //        return 'git gud';
    //    })->name('share-video')->middleware('signed');

    //     Route::get('/playground', function (){

    //         event(new ChatMessageEvent());
    // //        $url = URL::temporarySignedRoute('share-video', now()->addSeconds(30), [
    // //            'video' => 123
    // //        ]);
    // //        return $url;
    //        return null;
    //     });

    // Route::get('/ws', function (){
    //     return view('websocket');
    // });

    // Route::post('/chat-message', function (\Illuminate\Http\Request $request){
    //     event(new ChatMessageEvent($request->message, auth()->user()));
    //     return null;
    // });
}