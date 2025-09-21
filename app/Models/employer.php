<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class employer extends Model
{
    use HasFactory;

    protected $fillable = [
    'departement_id',
    'nom',
    'prenom',
    'email',
    'contact',
    'montant_journalier',];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Get all of the comments for the employer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(payment::class);
    }

}
