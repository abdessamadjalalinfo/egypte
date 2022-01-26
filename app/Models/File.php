<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
    public function subdepartement()
    {
        return $this->belongsTo(SubDepartement::class, 'sub_departement_id');
    }
}
