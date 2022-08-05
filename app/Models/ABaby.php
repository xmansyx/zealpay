<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ABaby extends Authenticatable
{
    use HasFactory;

    protected $table = 'babies';
    protected $guarded = [
        'id'
    ];

    public function parent(){
        return $this->belongsTo(AParent::class);
    }

}
