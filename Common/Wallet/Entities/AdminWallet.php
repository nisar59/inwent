<?php

namespace Common\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminWallet extends Model
{
    use HasFactory;
    protected $table='admin_wallet';
    protected $fillable = ['user_id','total_available_balance','total_credit_balance','total_debit_balance'];
    
    protected static function newFactory()
    {
        return \Common\Wallet\Database\factories\AdminWalletFactory::new();
    }
}
