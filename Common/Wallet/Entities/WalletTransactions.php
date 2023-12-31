<?php

namespace Common\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
class WalletTransactions extends Model
{
    use HasFactory;
    protected $table='wallet_transactions';
    protected $fillable = ['user_id','wallet_id','transaction_module','transaction_type','amount','user_to','wallet_to','transaction_id','status','remarks','logs'];
    protected $with=['user'];
    protected static function newFactory()
    {
        return \Common\Wallet\Database\factories\WalletTransactionsFactory::new();
    }

    public function user()
    {
       return $this->hasOne(User::class, 'id', 'user_id');
    }
}
