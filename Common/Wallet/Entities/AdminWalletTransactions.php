<?php

namespace Common\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Common\Wallet\Entities\WalletTransactions;
class AdminWalletTransactions extends Model
{
    use HasFactory;

    protected $table='admin_wallet_transactions';
    protected $fillable = ['admin_id','admin_wallet_id','user_wallet_transaction_id','transaction_type','amount','transaction_id','status','remarks','logs'];
    protected $with=['user_transaction'];
    protected static function newFactory()
    {
        return \Common\Wallet\Database\factories\AdminWalletTransactionsFactory::new();
    }

    public function user_transaction()
    {
        return $this->hasOne(WalletTransactions::class, 'id', 'user_wallet_transaction_id');
    }

}
