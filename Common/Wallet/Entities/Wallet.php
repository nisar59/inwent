<?php

namespace Common\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Common\Wallet\Entities\WalletTransactions;
class Wallet extends Model
{
    use HasFactory;
    protected $table='wallet';
    protected $fillable = ['user_id','total_available_balance','total_credit_balance','total_debit_balance'];
    protected $with=['transactions'];
    protected static function newFactory()
    {
        return \Common\Wallet\Database\factories\WalletFactory::new();
    }


    public function transactions()
    {
       return $this->hasMany(WalletTransactions::class, 'wallet_id', 'id');
    }
}
