<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoansDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'loans_id',
        'repayment_amount',
        'repayment_due_date',
        'status',
        'repayment_date'
    ];

    public function LoansId(){
        $id = Auth::user()->id;
        return $this->hasOne(Loans::class,'id','loans_id')->where('user_id', $id)->where('status','Approved');
        //return $this->belongsTo(Loans::class,'loans_id','id')->where('user_id', '=',$id)->where('status','=','Approved');
    }
}
