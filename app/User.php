<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','district_id','sk'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'birth_date'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_profile_url()
    {
        return route('profile.edit');
    }

    public function adminlte_desc()
    {
        return 'Member since '.$this->created_at->format('d M Y');
    }

    public function adminlte_image()
    {
        if ($this->photo_profile_path)
        {
            return env('APP_URL').'/'.$this->photo_profile_path;
        }
        
        return env('APP_URL').'/img/user.jpg';
    }

    public function isApproved()
    {
        return $this->is_approved == 1;
    }

    // accessor
    /**
     * Get the birth_date_form
     *
     * @param  string  $value
     * @return string
     */
    public function getBirthDateFormAttribute()
    {
        if($this->birth_date)
            return $this->birth_date->format('d-m-Y');
        else
            return null;
    }
}
