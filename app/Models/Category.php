<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kategori');
        $table->timestamps();
    });
    
}
