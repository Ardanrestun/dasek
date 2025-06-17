<?php

namespace App\Models\Data;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_siswa',
        'nisn',
        'nis',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'kelas_id',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   public function waliMurid()
    {
        return $this->hasMany(WaliMurid::class, 'siswa_id');
    }
}
