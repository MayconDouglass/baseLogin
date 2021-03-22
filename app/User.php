<?php

namespace App;

use App\Models\Perfil;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	public $timestamps = false;

	protected $casts = [
		'idPerfil' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'idPerfil',
		'nome',
		'email',
		'password',
		'remember_token',
		'avatar',
		'status'
	];

	public function rPerfil()
	{
		return $this->belongsTo(Perfil::class, 'idPerfil');
	}
}
