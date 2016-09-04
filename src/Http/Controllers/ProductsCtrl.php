<?php
/**
 * Created by PhpStorm.
 * User: Jenova13
 * Date: 02.09.16
 * Time: 12:36
 */

namespace jenova13q\Test\Http\Controllers;

use App\Http\Controllers\Controller;
use jenova13q\Test\Models\Product as Product;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth as Auth;
use Validator;

class ProductsCtrl extends Controller
{

	private $type;

	public function __construct() {
//		$this->type =  $this->app('current_user_type');

		if (Auth::check()) {
			$type =  Auth::user()->type;
			if($type == "manager" || $type == "admin") {
				$this->type = $type;
				return;
			}
		}
		abort(401);
	}

	public function index() {
		$products = Product::all();
		$type = $this->type;

		return view('Test::products', compact('products', 'type'));
	}

	public function show($id) {
		$product = Product::findOrFail($id);
		$type = $this->type;

		return view('Test::product', compact('product', 'type'));
	}

	public function store(Request $request) {
		$input =  $request->input();

		$validator = Validator::make($input, [
			'name'  => 'required|min:10',
			'art'   => 'required|unique:products,art|alpha_num'
		]);

		if ($validator->fails()) {
			return redirect('products/')
				->withInput()
				->withErrors($validator);
		}

		$product = new Product;

		$product->name = $input['name'];
		$product->art = $input['art'];

		$product->save();

		return redirect('products/');
	}

	public function update($id, Request $request) {
		$input =  $request->input();

		$validator = Validator::make($input, [
			'name'  => 'min:10',
			'art'   => 'unique:products,art|alpha_num'
		]);

		if ($validator->fails()) {
			return redirect('/product/'.$id)
				->withInput()
				->withErrors($validator);
		}

		$product = Product::findOrFail($id);

		switch ($this->type) {
			case 'admin':
				$can = ['name', 'art'];
				break;
			case 'manager':
				$can = ['name'];
				break;
			default:
				$can = [];
		}

		foreach($can as $column) {
			if(isset($input[$column]))
				$product->$column = $input[$column];
		}

		$product->save();

		return redirect('products/');
	}

	public function destroy($id) {
		$product = Product::findOrFail($id);
		$product->delete();

		return redirect('products/');
	}


}