<?php

namespace App\Models;

use App\Traits\Reports\ReportFilterTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
  use HasFactory, Notifiable, HasRoles, SoftDeletes, ReportFilterTrait;


    protected $fillable = [
        'name',
        'surname',
        'email',
        'status',
        'phone',
        'password',
        'gender',
        'google_id',
        'birth_date',
        'country_id',
    ];


  protected $hidden = ['password'];

  protected $defaultFields = ['gender', 'country_id'];
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  public function getJWTCustomClaims()
  {
    return [];
  }

  public function country()
  {
    return $this->belongsTo(Country::class, 'country_id');
  }

  public function carts(){
    return $this->hasMany(Cart::class);
  }


  public function museum(){
    return $this->hasOne(Museum::class);
  }

  public function museum_staff_admin(){
    return $this->hasMany(MuseumStaff::class, 'admin_id');
  }

  public function museum_staff_user(){
    return $this->hasOne(MuseumStaff::class, 'user_id');
  }

  public function roleNames(): array
  {

    return $this->roles->pluck('name')->toArray();
  }

  public function getStaff()
  {
    return $this->belongsToMany(User::class, 'museum_staff',  'admin_id','user_id');
  }

  public function logs()
  {
    return $this->hasMany(Log::class);
  }

  public function hasInStaff($id)
  {
      $user = $this->museum_staff_admin()->where('user_id', $id)->first();
      return $user != null ? true : false;
  }

  public function isAdmin()
  {

    foreach ($this->roles()->get() as $role) {
      if ($role->interface == "admin" || $role->interface ==  "museum") {
        return $role->interface;
      }
      else{
        return false;
      }
    }

    return false;
  }

  public function user_staff()
  {

    return $this->hasMany(MuseumStaff::class);
  }

  public function purchases()
  {
    return $this->hasMany(Purchase::class);
  }


}
