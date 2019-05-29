<?php

namespace BahatiSACCO;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = "loans";

    protected $fillable = [
        "member_id", "amount", "monthly_repayment_amount", "repayment_period", "serial_number",
        "bank_name", "bank_branch", "bank_account_name", "bank_account_number"
    ];

    function member(){
        return $this->belongsTo(Member::class, "member_id", "id");
    }
}
