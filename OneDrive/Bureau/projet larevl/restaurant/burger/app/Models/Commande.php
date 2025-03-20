<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CommandeGroup;
use App\Models\User;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Commande extends Model
{
    protected $fillable = [
        'user_id',
        'produit_id',
        'quantite',
        'prix',
        'prix_total',
        'statut',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }


    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commandeproduits')
            ->withPivot('quantite', 'prix', 'prix_total')
            ->withTimestamps();
    }
}
