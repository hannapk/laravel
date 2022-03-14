<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static create(array $array)
 * @method static User whereConfirmCode($code)
 * @method static User whereEmail(mixed $get)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'confirm_code', 'activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        'confirm_code',
    ];

    /**
     * 데이터베이스 타입을 모델 타입으로 자동 캐스팅한다.
     *
     * @var string[]
     */
    protected $casts = [
        'activated' => 'boolean',
    ];

    public function articles() {
        return $this->hasMany(Article::class);
    }
}
