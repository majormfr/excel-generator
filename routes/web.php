<?php

use App\Events\InterviewCreated;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Traits\CurlTrait;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sort-array',function(){
    function mergeSort($arr){
        if(count($arr)<1){
            return $arr;
        }else{
            $pivot = $arr[0];

        $left = $right = array();

        for($i=1;$i<count($arr);$i++){
        
            if($arr[$i] < $pivot){
                $left[] = $arr[$i];
            }else{
                $right[] = $arr[$i];
            }
        }
        return array_merge(mergeSort($left),array($pivot),mergeSort($right));
    }}
   print_r(mergeSort([1,5,2]));
});
Route::get('/sort-assoc/',function(){
    function sortAssoc($arr){
        // [{'name'=>'fahad'},{'name'=>'saad'},{'name'=>"fahad"}]
     
       return array_reduce($arr,function($accumulator,$item){
            if(!in_array($item,$accumulator)){
                echo json_encode($item);
                $accumulator[]=$item;
            }
            return $accumulator;
        },[]);
    }
echo    json_encode(sortAssoc([['name'=>'fahad'],['name'=>'saad'],['name'=>'fahad']]));
   
        // echo json_encode(sortAssoc([1,2,1,3]));

   
});

Route::get('/sort-assoc-by-key',function(){
    function sortAssocByKey($arr){
        $orders = array();
        foreach($arr as $k => $v){

            $orders[] = $v['id'];
        }
      array_multisort($orders,SORT_ASC,$arr);
      dd($orders);
    }

    echo json_encode(sortAssocByKey([['id'=>1,'name'=>'A'],['id'=>5,'name'=>'C'],['id'=>2,'name'=>'B']]));
});

Route::controller(App\Http\Controllers\PostController::class)->group(function(){
    Route::get("/post",'index');
});
Route::get('/user-posts',function(){
    $user = User::whereHas('myPosts', function (Builder $query) {
        $query->where('title', 'Lets get busy is banned');
    })->first()->with('myPosts')->first();
// max()
    // str_word_count()
    
    dd($user);
});

Route::get('/morph',function(){
    $r = Image::whereHasMorph('imageable',[User::class,Post::class],function(Builder $query){
        $query->where('image_url','like', '%yahoo%');

    })->get();
    dd($r);
});

Route::get('/event',function(){
    event(new InterviewCreated(User::first()));

});

Route::get("/longest word in a snetence",function(){

    function LongestWord($sen) {  

  // code goes here
  
  $textarray = str_word_count($sen, 1);
  $mapping = array_combine($textarray, array_map('strlen', $textarray));     
  $keys = array_keys($mapping, max($mapping));  
  return $keys[0];     
}
});

Route::get("/generate-zip-code",[App\Http\Controllers\SpreadsheetController::class,'index']);