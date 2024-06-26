<?php
namespace App\Repositories\MuseumBranches;

use App\Interfaces\MuseumBranches\MuseumBranchesRepositoryInterface;
use App\Models\Image;
use App\Models\Link;
use App\Models\Museum;
use App\Models\MuseumBranch;
use App\Models\MuseumBrancheTranslation;
use App\Models\MuseumStaff;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MuseumBranchRepository implements MuseumBranchesRepositoryInterface
{

  public function all(){


    if(auth()->user()->user_staff->first()->museum==null){

      return false;
    }

    $museum_id = auth()->user()->user_staff->first()->museum->museum_branches->pluck('id');


    return MuseumBranch::whereIn('id',$museum_id)->with(['museum_branche_translations','images'])->orderBy('id','desc')->get();


  }

  public  function creat($museumId){

    return $data = MuseumStaff::where(['user_id'=>Auth::id(),'museum_id'=>$museumId])->first();
  }

  public function store($request){


$museum_branches = MuseumBranch::create([
        'museum_id'=>$request['museum_id'],
        'email'=> $request['email'],
        'phone_number'=>$request['phone_number']]);

        if($museum_branches){

          foreach($request['translate'] as $key => $lang){

            $lang['museum_branch_id'] = $museum_branches->id;
            $lang['lang'] = $key;

            $newstranslate = MuseumBrancheTranslation::create($lang);

          }
        }
        if($photo = $request['photo'] ?? null){

          $path = FileUploadService::upload($request['photo'],'museum_branches/'.$museum_branches->id);
            $photoData = [
              'path' => $path,
              'name' => $photo->getClientOriginalName()
          ];
          $museum_branches->images()->create($photoData);

        }
        if($link = $request['link'] ?? null){
          $link = [
            'link' => $request['link'],
            'name' => 'website'
          ];
          $museum_branches->links()->create($link);

        }
          return true;




  }
  public function find($id){
     return  MuseumBranch::find($id);

  }
  public function update($request,$id){

    $museum_branch = $this->find($id);
    $museum_branch->email = $request['email'];
    $museum_branch->phone_number = $request['phone_number'] ?? null;
    $museum_branch->save();

    if($museum_branch){
        if(isset($request['photo'])){
          $image = Image::where(['imageable_id'=>$id,'imageable_type'=>'App\Models\MuseumBranch'])->first();
          if(Storage::exists($image->path)){
            Storage::delete($image->path);
            $image = Image::where(['imageable_id'=>$id,'imageable_type'=>'App\Models\MuseumBranch'])->delete();

          }
          $path = FileUploadService::upload($request['photo'], 'museum_branches/'.$id);
          $photoData = [
              'path' => $path,
              'name' => $request['photo']->getClientOriginalName()
          ];

          $museum_branch->images()->create($photoData);
        }

        if($request['link']){

          $link = Link::where(['linkable_id'=>$id,'linkable_type'=>'App\Models\MuseumBranch'])->first();

          if($link!=null){
            $link->link = $request['link'];
            $link->save();
          }else{
            $linkData = [
              'link' => $request['link'],
              'name' => 'website'
            ];
            $museum_branch->links()->create($linkData);

          }

        }else{
          $link = Link::where('linkable_id',$id)->first();
          if($link){
            $link->delete();
          }

        }

      foreach($request['translate'] as $key=>$lang){

        $lang['museum_branch_id'] = $id;
        $lang['lang'] = $key;


        $museum_branche_translate = MuseumBrancheTranslation::where(['museum_branch_id'=>$id,'lang'=>$key])->first();
        $museum_branche_translate->update($lang);

      }
        session(['success' => 'Գործողությունը հաջողությամբ իրականացվեց']);
        return true;
    }

 }

}

