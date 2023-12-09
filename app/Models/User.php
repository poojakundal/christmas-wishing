<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Facade as Avatar;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'gender',
        'birth_date',
        'phone_number',
        'profile_picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_picture_path',
    ];

    public function wishList()
    {
        return $this->hasMany(WishList::class);
    }

    public function group()
    {
        return $this->hasMany(Group::class);
    }

    public function getProfilePicturePathAttribute() 
    {
        if(is_null($this->profile_picture)) 
        {
            return Avatar::create($this->first_name . ' ' . $this->last_name)->toBase64();
        }

        // return {{ asset('storage/item_picture/'.$myWishList->item_picture) }}$this->profile_picture;
        return asset('storage/profile_picture/' . $this->profile_picture);
    }
}
