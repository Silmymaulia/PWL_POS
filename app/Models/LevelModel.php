<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Definisikan tabel yang digunakan oleh model ini
    protected $primaryKey = 'level_id'; // Primary key dari tabel m_level

    // Jika Anda menggunakan timestamps, biarkan default (created_at, updated_at),
    // jika tidak, Anda bisa mematikannya dengan:
    public $timestamps = false;

    protected $fillable = ['level_nama']; // Isi kolom yang dapat diisi melalui mass assignment

    // Anda juga bisa menambahkan relasi ke model User jika diperlukan
    public function users()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}
