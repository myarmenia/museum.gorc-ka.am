<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MuseumBrancheTranslation extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function museum_branches(){
      return $this->belongsTo(MuseumBranch::class,"museum_branch_id");
    }

}
