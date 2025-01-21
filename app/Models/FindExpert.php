<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindExpert extends Model
{
    use HasFactory;
    public function state_name()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }
    public function city_name()
    {
        return $this->hasOne(City::class, 'id', 'city');
    }
    public function category_name()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->with('lead_price');
    }
    public function lead_price(){
        return $this->hasOne(LeadPrice::class, 'id', 'category_id');
    }
}
