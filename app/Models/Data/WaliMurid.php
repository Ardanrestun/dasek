<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    protected $table = 'walimurid';
    protected $fillable =[
        'nama_walimurid',
        'hubungan',
        'pekerjaan',
        'jenis_kelamin',
        'no_telepon',
        'siswa_id'
    ];

    public $incrementing = false;

    protected $keyType = 'string';


     protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        });
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

}
