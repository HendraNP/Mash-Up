<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Loans;
use App\Models\User;
use App\Models\LoansDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DB;

class LoansController extends Controller
{
    //Loans
    public function index()
    {
    	$list = Loans::where('user_id',Auth::user()->id)->get();
        return view('loans.index', ['list' => $list]);
    }

    public function addloans()
    {
        return view('loans.addloans');
    }

    public function addnewloans(Request $request)
    {
        $request->validate([
            'loan_amount' => ['required', 'numeric'],
            'loan_term' => ['required', 'numeric'],
        ]);

        if(Auth::user()->status != 'Normal'){
            $list = Loans::find(Auth::user()->id);
            return redirect()->to('/loans')->with(['message' => 'unable to apply for loans']);
        }
        
        $loans = new Loans;
        $loans->loan_amount = $request->loan_amount;
        $loans->user_id = Auth::user()->id;
        $loans->status = 'WPA';
        $loans->loan_term = $request->loan_term;
        $loans->save();

        $list = Loans::find(Auth::user()->id);
            return redirect()->to('/loans')->with(['message' => 'New Loans waiting for approval']);
    }

    //Approval
    public function approval(){
        $list = Loans::where('status','WPA')->get();
        return view('approval.index', ['list' => $list]);
    }

    public function approvaldetail($id){
        $list = Loans::find($id);
        return view('approval.detail', ['list' => $list]);
    }

    public function approveloans(Request $request){
        $id = $request->id;
        $loans = Loans::find($id);
        $loans->status = 'Approved';
        $loans->approve_on = Carbon::now();
        $loans->save();

        $currDate = Carbon::today();
        for($i = 0;$i < $loans->loan_term; $i++){
            $detail = new LoansDetail;
            $detail->loans_id = $id;
            $amount = $loans->loan_amount / $loans->loan_term;
            $detail->repayment_amount = $amount;
            $detail->repayment_due_date = $currDate = $currDate->addWeek();
            $detail->status = 'Pending';
            $detail->save();
        }

        return redirect()->to('approval')->with(['message' => 'Loans Approved']);
    }

    public function repayment(){
        $id = Auth::user()->id;
        $list = Loans::with('LoansDetails')->where('user_id',$id)->where('status','Approved')->get();
        return view('repayment.index', ['list'=> $list]);
    }

    public function settlerepayment($id){
        $user = User::find(Auth::user()->id);
        $loandetail = LoansDetail::find($id);
        $loanid = Loans::find($loandetail->loans_id);

        

        if($user->user_balance < $loandetail->repayment_amount){
            return back()->with(['message'=> 'Balance not enough for repayment']);
        }else{
            $user->user_balance-=$loandetail->repayment_amount;
            $loandetail->status = 'Paid';
            $user->save();
            $loandetail->save();

            $listloandetail = LoansDetail::where('loans_id',$loanid->id)->where('status','Pending')->get();
            if($listloandetail->isEmpty()){
                $loanid->status = 'Fully Paid';
                $loanid->fully_paid_on = Carbon::now();
                $loanid->save();
                return redirect()->to('repayment')->with(['message' => 'Loans Fully Paid']);
            }
            return redirect()->to('repayment')->with(['message' => 'Loans partially paid']);
        }
    }
}
