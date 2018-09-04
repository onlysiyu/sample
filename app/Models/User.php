<?php

namespace App\Models;

use Auth;
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

        // 通过 followings 方法取出所有关注用户的信息，再借助 pluck 方法将 id 进行分离并赋值给 user_ids
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        // 将当前用户的 id 加入到 user_ids 中
        array_push($user_ids, Auth::user()->id);

        //补充 $user->followings 与 $user->followings() 调用时返回的数据不一样，前者返回Eloquent集合，后者为数据库请求构建器


        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);

        return Status::whereIn('user_id', $user_ids)
                                ->with('user')
                                ->orderBy('created_at', 'desc');
    }



    //获取粉丝关系列表
    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    //获取关注人列表
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }


    //关注&取消关注
    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }

        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }

        $this->followings()->detach($user_ids);
    }



    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }

}
