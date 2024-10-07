<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; //implementasi class authenticatable

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'password', 'nama', 'level_id', 'created_at', 'updated_at'];

    protected $hidden = ['password']; // jangan di tampilkan saat select

    protected $casts = ['password' => 'hashed']; // casting password agar otomatis di hash

    /**
    * Relasi ke tabel level
    */
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}


// class UserModel extends Model
// {
//     use HasFactory;

//     // Mendefinisikan nama tabel yang digunakan oleh model ini
//     protected $table = 'm_user';

//     // Mendefinisikan primary key dari tabel
//     protected $primaryKey = 'user_id';

//     // Kolom yang bisa diisi massal
//     protected $fillable = ['level_id', 'username', 'nama', 'password'];

//     // Relasi ke model LevelModel
//     public function level(): BelongsTo
//     {
//         return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
//     }
// }
