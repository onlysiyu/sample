<?php

namespace App\Models;

//use Auth;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table  = 'users';

    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 过滤用户提交的字段，只有在fillable中的字段才能被正常更新
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];



    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }



    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }



    public function statuses()
    {
        return $this->hasMany(Status::class);
    }



    public function feed()
    {
        return $this->statuses()
                        ->orderBy('created_at', 'desc');
    }

}
