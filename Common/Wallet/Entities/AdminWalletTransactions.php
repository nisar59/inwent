<?php

namespace Common\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminWalletTransactions extends Model
{
    use HasFactory;

    protected $table='admin_wallet_transactions';
    protected $fillable = ['admin_id','admin_wallet_id','user_wallet_transaction_id','amount','transaction_id','status','remarks','logs'];
    
    protected static function newFactory()
    {
        return \Common\Wallet\Database\factories\AdminWalletTransactionsFactory::new();
    }
}
