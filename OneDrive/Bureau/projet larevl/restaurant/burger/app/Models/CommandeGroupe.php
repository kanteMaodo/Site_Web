<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeGroupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prix_total',
        'statut',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
