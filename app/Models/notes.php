<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    use HasFactory;
        // Nama tabel, jika tidak sesuai dengan plural bawaan Laravel
        protected $table = 'notes';

        // Kolom-kolom yang dapat diisi (fillable)
        protected $fillable = ['user_id', 'Note', 'Mood'];


}
