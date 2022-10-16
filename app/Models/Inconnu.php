<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inconnu extends Model
{
    use HasFactory;

    
    protected $guarded=[];

    public function carte()
    {
        return $this->belongsTo(Carte::class);
    }
}
