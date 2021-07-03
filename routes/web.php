<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function(){
    $res = \App\Models\Expense::where('user_id', 1)->get();
    $total = 0;
    foreach ($res as $item) {
        $category = \App\Models\Category::where('user_id', 1)->where('id', $item->category_id)->first()->name;
        echo "$category : $item->amount Р. <br>";
        $total += $item->amount;
    }
    echo "<br>";
    echo "Всего: $total Р.";
});



