<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni',
        'surnames',
        'names',
        'id_area',
        'fecha_hora'
    ];
    public function area(){
        return $this->belongsTo(Area::class, 'id_area');
    }
}
