<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'description',
        'image',
        'stock',
    ];

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commandeproduits')
            ->withPivot('quantite', 'prix', 'prix_total')
            ->withTimestamps();
    }
}
