<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'indonesia_villages';

    protected $fillable = [
        'code', 'district_code', 'name',
    ];

    // If you don't want to manually handle the timestamps, you can let Eloquent handle it for you
    public $timestamps = true;

    // If the timestamps fields are named differently in the database, define the constants
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
