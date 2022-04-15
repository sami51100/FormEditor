<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forms extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $fillable = [
		'title',
		'description',
		'date',
		'color',
		'progress',
		'user_id',
		'groupe_id',
		'formulaire',
		'logo',
	];

	protected $dates = [
		'created_at',
		'deleted_at',
		'started_at',
		'update_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function usersGroupe()
	{
		return $this->belongsToMany(User::class);
	}
}
