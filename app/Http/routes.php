<?php
use App\TodoItems;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('todoitems', [
    	'todoitems' => TodoItems::orderBy('created_at', 'asc')->get()
    ]);
});

Route::post('/todoitems', function (Request $request) {

		$validator = Validator::make($request->all(), [
		'title' => 'required|max:255',
		'description'=>'required|max:900'
	]);

	if ($validator->fails()) {
		return redirect('/#'.$request->tabName)
			->withInput()
			->withErrors($validator);
	}

	$todoitems = new TodoItems;
	$todoitems->title = $request->title;
	$todoitems->description=$request->description;
	$todoitems->save();
	return redirect('/#tabs-1');

	});

Route::delete('/todoitems/{id}', function ($id) {
	TodoItems::findOrFail($id)->delete();

	return redirect('/');
});

Route::post('/todoitems/{id}', function ($id,Request $request) {
	$todoitems=TodoItems::findOrFail($id);
	$todoitems->title = $request->title;
	$todoitems->description=$request->description;
    
   
    $validator = Validator::make($request->all(), [
		'title' => 'required|max:255',
		'description'=>'required|max:900'
	]);

	if ($validator->fails()) {
		return redirect('/#tabs-1')
			->withInput()
			->withErrors($validator);
	}



	$todoitems->save();
	return redirect('/');
	});

