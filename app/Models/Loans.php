<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'loan_amount',
        'loan_term',
        'status',
        'approve_on',
        "fully_paid_on",
        'created_at'
    ];

    public function LoansUser(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function LoansDetails(){
        return $this->hasMany(LoansDetail::class,'loans_id','id')->where('status','Pending');
    }
}
