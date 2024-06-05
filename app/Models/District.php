<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'indonesia_districts';

    protected $fillable = [
        'code', 'name'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_code', 'code');
    }
}
