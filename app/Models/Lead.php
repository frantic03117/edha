<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    public function search_data(){
        return $this->hasOne(FindExpert::class, 'id', 'search_id')->with('category_name')->with('state_name')->with('city_name');
    }
    public function assigns(){
        return $this->hasMany(ExpertPoint::class, 'lead_id', 'id');
    }
    public function assigns_confirm(){
        return $this->hasMany(ExpertPoint::class, 'lead_id', 'id')->where('is_confirm', '1');
    }
}