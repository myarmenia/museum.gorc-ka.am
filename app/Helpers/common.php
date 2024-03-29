<?php

use App\Models\Country;
use App\Models\EducationalProgram;
use App\Models\Museum;
use App\Models\MuseumStaff;
use App\Models\TicketType;
use App\Models\TicketUnitedSetting;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

function translateMessageApi($message, $lang=null)
{
    $lang = $lang ? $lang : session('languages', 'am');
    $translation = new Translation($lang);

    return $translation->get($message);
}

function getProjectDescription($translation)
{
    $lang = session('languages');
    $descriptoin = $translation->where('lang', $lang)->first()->description;

    return $descriptoin;
}

function getCourseLanguagesDescription($translation)
{
    $lang = session('languages');
    $descriptoin = $translation->where('lang', $lang)->first()->description;

    return $descriptoin;
}

function getProjectDescriptionForAdmin($translation, $lang)
{
    $descriptoin = $translation->where('lang', $lang)->first()->description;

    return $descriptoin;
}


function roles_intersect($data){

  $auth_roles = Auth::user()->roleNames();
  array_push($auth_roles, 'all');

  return array_intersect($auth_roles, $data);
}

if(!function_exists('languages')){
  function languages(){

      return [
        'am','ru','en'
      ];

  }

}

if(!function_exists('languagesName')){
    function languagesName($key){
        $arr = [
            'am' => 'հայերեն',
            'ru' => 'ռուսերեն',
            'en' => 'անգլերեն',
        ];

        return $arr[$key];

    }
}

if(!function_exists('getLinkType')){
    function getLinkType(){

        return [
            'facebook', 'instagram', 'web_site', 'virtual_tour',
        ];

    }
}

if(!function_exists('getLinkNames')){
    function getLinkNames($key){

        $arr = [
            'facebook' => 'Ֆեյսբուք',
            'instagram' => 'Ինստագրամ',
            'virtual_tour' => 'Վիրտուալ էքսկուրսիա',
            'web_site' => 'Վեբ-սայթ',
        ];

        return $arr[$key];

    }
}

if(!function_exists('museumPhoneCount')){
    function museumPhoneCount(){
        return [
            'phone1', 'phone2', 'phone3',
        ];
    }
}

if(!function_exists('haveMuseumAdmin')){
    function haveMuseumAdmin()
    {
        if(auth()->user()->roles()->get()->where('name', 'museum_admin')->count()) {
            return true;
        };

        return false;
    }
}

if(!function_exists('isSuperAdmin')){
    function isSuperAdmin()
    {
        if(auth()->user()->roles()->get()->where('name', 'super_admin')->count()) {
            return true;
        };

        return false;
    }
}

if(!function_exists('haveMuseum')){
    function haveMuseum()
    {
        if($museum = Museum::where('user_id', auth()->id())->first()) {
            return $museum->id;
        };

        return false;
    }
}

if(!function_exists('museumAccessId')){
  function museumAccessId()
  {
      return Auth::user()->museum_staff_user ? Auth::user()->museum_staff_user->museum_id : false;
  }
}


if(!function_exists('getAuthMuseumId')){
    function getAuthMuseumId()
    {
        $authId = auth()->id();

        if($museum = MuseumStaff::where('user_id', $authId)->first()) {
            return $museum->museum_id;
        };

        return false;
    }
}

if (!function_exists('allRoles')) {
  function allRoleNames()
  {
    return Role::all()->pluck('name', 'name')->toArray();
  }

}

if (!function_exists('museumEducationalPrograms')) {
  function museumEducationalPrograms()
  {

    return museumAccessId() ? EducationalProgram::where('museum_id', museumAccessId())->get() : [];
  }

}

if (!function_exists('ticketType')) {
  function ticketType($type)
  {
   return TicketType::where('name', $type)->first();
  }

}

if (!function_exists('unitedTicketSettings')) {
  function unitedTicketSettings()
  {
    return TicketUnitedSetting::first();
  }

}
if (!function_exists('notifications')) {
  function notifications()
  {
    $user = auth('api')->user();
    $notification = $user->unreadNotifications;
    return $notification;
  }

}

function generateToken()
{
  return md5(rand(1, 8) . microtime());
}

if (!function_exists('getCountryId')) {
    function getCountry($key)
    {
      return Country::where('key', $key)->first();
    }

}




