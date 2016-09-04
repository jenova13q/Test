<?php
namespace jenova13q\Test\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Product extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'products';
	protected $fillable = [
		'name', 'art'
	];
	protected $hidden = array('deleted_at', 'updated_at', 'created_at');

}