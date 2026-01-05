<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StuController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        "zhuzhu"=>'hello world333',
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 文章资源路由（CRUD）
    Route::resource('articles', ArticleController::class);
});



Route::get('test',function(){
    $user = [
        'age'=> 17,
        'sadasda',
        'name'=>"张三",
    ];
    return $user;
});

// Route::get('test2',function(){
   
//     return 'HELLO WORLD';
// });
Route::get('test2',function(){
   
    return view('test2');
});
Route::match(['get','update'],'test3',function(){
   
    return "helloworld sadsada111";
});

Route::get('/stu',[StuController::class,'getStuLists'])->name('stu.array');

require __DIR__.'/auth.php';
