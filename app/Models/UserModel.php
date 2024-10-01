<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $table = 'm_user';

    // Mendefinisikan primary key dari tabel
    protected $primaryKey = 'user_id';

    // Kolom yang bisa diisi massal
    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    // Relasi ke model LevelModel
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
