<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameBalance extends Model
{
    use HasFactory;
    protected $table = 'game_balance';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'balance_type',
        'game_name',
        'balance_amount',
        'status',
    ];
}
