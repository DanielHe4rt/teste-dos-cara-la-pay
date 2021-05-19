<?php


namespace App\Models\Transactions;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $incrementing = false;

    protected $table = 'wallet_transactions';

    protected $fillable = [
        'id', 'payee_id', 'payer_id', 'amount'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
