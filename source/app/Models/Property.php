<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function type(){
        return $this->belongsTo(PropertyType::class,'ptype_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'agent_id','id');
    }

    public function localArea(){
        return $this->belongsTo(LocalArea::class);
    }

    public function pamenities(){

        return $this->hasMany(Amenities::class,'amenities_id','id');
    }


}
