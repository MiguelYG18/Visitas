<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'names',
    ];
    public function user(){
        return $this->hasMany(User::class, 'id_area');
    }
}
