<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    
    protected $appends = ['balance'];
    
    public function getBalanceAttribute()
    {
        // Calculate the balance points for the expert
        $totalCredit = ExpertPoint::where('expert_id', $this->id)
            ->where('type', 'Credit')
            ->where('is_confirm', '1')
            ->sum('points');

        $totalDebit = ExpertPoint::where('expert_id', $this->id)
            ->where('type', 'Debit')
            ->where('is_confirm', '1')
            ->sum('points');

        return [
            'total_credit' => $totalCredit,
            'total_debit' => $totalDebit,
            'balance' => $totalCredit - $totalDebit,
        ];
    }
      
    public function category()
    {
        return $this->belongsToMany(Category::class, ExpertCategory::class,  'expert_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, ExpertCategory::class,  'expert_id', 'category_id');
    }
    
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function expertize()
    {
        return $this->belongsToMany(SubCategory::class, ExpertSubCategory::class, 'expert_id', 'sub_category_id');
    }
    public function fee()
    {
        return $this->hasMany(ExpertFee::class, 'expert_id', 'id');
    }
    public function slots()
    {

        date_default_timezone_set('Asia/kolkata');
        $cH = date('H');

        $ch =  $cH . ':00:00';

        $cgap = SlotTimeGap::where('current_hour', $ch)->first();

        $gap = $cgap['hour_gap'];
        $date = date('Y-m-d H:i:s', strtotime("+{$gap} hours"));
        return $this->hasMany(Slot::class, 'expert_id', 'id')->where('slot', '>', $date)->where('is_paid', '0')->orderBy('slot', 'ASC');
    }
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
    public function postname()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function video_package()
    {
        $fdata = [
            'status' => 'Done',
            'mode' => 'Video'
        ];
        return $this->hasMany(UserSession::class, 'expert_id', 'id')->where($fdata)->where('slot_id', '!=', null);
    }
    public function audio_package()
    {
        $fdata = [
            'status' => 'Done',
            'mode' => 'Audio'
        ];
        return $this->hasMany(UserSession::class, 'expert_id', 'id')->where($fdata)->where('slot_id', '!=', null);
    }
    public function single_package()
    {
        return $this->hasMany(Cart::class, 'expert_id', 'id')
            ->whereIn('package_id', function ($q) {
                $q->select('id')->from('packages')->where('quantity', '1');
            })->where('payment_status', 'Success');
    }
    public function multi_package()
    {
        return $this->hasMany(Cart::class, 'expert_id', 'id')
            ->whereIn('package_id', function ($q) {
                $q->select('id')->from('packages')->where('quantity', '!=', '1');
            })->where('payment_status', 'Success');
    }
    public function  open_sessions()
    {
        return $this->hasMany(UserSession::class, 'expert_id', 'id')->where('status', 'Pending')->where('slot_id', '!=', null);
    }
    public function  closed_sessions()
    {
        return $this->hasMany(UserSession::class, 'expert_id', 'id')->where('status', 'Done')->where('slot_id', '!=', null);
    }
    public function  cancelled_sessions()
    {
        return $this->hasMany(UserSession::class, 'expert_id', 'id')->where('status', 'Cancelled');
    }
    public function  rescheduled_sessions()
    {
        return $this->hasMany(UserSession::class, 'expert_id', 'id')->where('is_rescheduled', '1');
    }
    public function leads()
    {
        return $this->hasMany(ExpertPoint::class, 'expert_id', 'id')->where('lead_id', '!=', null);
    }
    public function confirm_leads()
    {
        return $this->hasMany(ExpertPoint::class, 'expert_id', 'id')->where('lead_id', '!=', null)->where('is_confirm', '1');
    }
    public function unconfirm_leads()
    {
        return $this->hasMany(ExpertPoint::class, 'expert_id', 'id')->where('lead_id', '!=', null)->where('is_confirm', '0');
    }
    public function recharges(){
         return $this->hasMany(ExpertPoint::class, 'expert_id', 'id')->where('type', 'Credit')->where('payment_status', 'Success');
    }
    public function photos()
    {
        return $this->hasMany(ExpertPhoto::class, 'expert_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(ExpertRating::class, 'expert_id', 'id');
    }
   
}