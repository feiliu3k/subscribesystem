<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $table = 'usercomment';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'company_id', 'productifo_id', 'commentcontent', 'sendtime', 'delflag', 'verifyflag'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productifo_id');
    }

    public function getSendtimeAttribute($date)
    {
         // 默认100天前输出完整时间，否则输出人性化的时间
        if (Carbon::now() > Carbon::parse($date)->addDays(100)) {
            return Carbon::parse($date);
        }
       
        return Carbon::now()->diffForHumans(Carbon::parse($date));
    }
}
