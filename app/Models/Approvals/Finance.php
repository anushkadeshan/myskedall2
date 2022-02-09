<?php

namespace App\Models\Approvals;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    public $timestamps = true;
    public $table = 'requests_payments';

    public $fillable = [
        'bank_id', 'agency', 'account', 'account_owner', 'cpf_cnpj', 'app_type', 'transaction_url', 'invoice_file', 'request_id' ,'payment_type','item_id'
    ];
}
