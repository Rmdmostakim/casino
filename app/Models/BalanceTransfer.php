<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceTransfer extends Model
{
    use HasFactory;
    protected $table = 'balance_transfer';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'balance_type',
        'transfer_method',
        'transfer_number',
        'balance_amount',
        'transection_id',
        'uc_amount',
        'status',
    ];
}
