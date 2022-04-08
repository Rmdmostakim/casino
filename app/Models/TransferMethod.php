<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferMethod extends Model
{
    use HasFactory;
    protected $table = 'transfer_method';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'method_name',
        'exchange_rate',
        'trx_number',
        'status',
    ];
}
