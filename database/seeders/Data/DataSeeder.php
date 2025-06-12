<?php

namespace Database\Seeders\Data;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Data\Guru;
use App\Models\Data\Kelas;
use App\Models\Data\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasData = [
            ['nama_kelas' => 'X IPA 1'],
            ['nama_kelas' => 'X IPA 2'],
            ['nama_kelas' => 'X IPA 3'],
            ['nama_kelas' => 'X IPS 1'],
            ['nama_kelas' => 'X IPS 2'],
            ['nama_kelas' => 'XI IPA 1'],
            ['nama_kelas' => 'XI IPA 2'],
            ['nama_kelas' => 'XI IPA 3'],
            ['nama_kelas' => 'XI IPS 1'],
            ['nama_kelas' => 'XI IPS 2'],
            ['nama_kelas' => 'XII IPA 1'],
            ['nama_kelas' => 'XII IPA 2'],
            ['nama_kelas' => 'XII IPA 3'],
            ['nama_kelas' => 'XII IPS 1'],
            ['nama_kelas' => 'XII IPS 2'],
            ['nama_kelas' => 'XII IPS 3'],

        ];

        foreach ($kelasData as $kelas) {
            Kelas::create($kelas);
        }


        $guruRole = Role::where('name', 'Guru')->first();
        $kelasIds = Kelas::pluck('id')->toArray();

        $guruData = [
            [
                'nama_guru' => 'Drs. Ahmad Wijaya',
                'nip' => '197801012005011001',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1978-01-01',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta',
                'no_telepon' => '081234567890',
                'email' => 'ahmad.wijaya@school.com',
            ],
            [
                'nama_guru' => 'Dr. Siti Nurhaliza, M.Pd',
                'nip' => '198205152006022001',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1982-05-15',
                'alamat' => 'Jl. Merdeka No. 456, Bandung',
                'no_telepon' => '081234567891',
                'email' => 'siti.nurhaliza@school.com',
            ],
            [
                'nama_guru' => 'M. Rizki Pratama, S.Pd',
                'nip' => '198909302010011002',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1989-09-30',
                'alamat' => 'Jl. Pahlawan No. 789, Surabaya',
                'no_telepon' => '081234567892',
                'email' => 'rizki.pratama@school.com',
            ],
            [
                'nama_guru' => 'Dewi Lestari, S.Si',
                'nip' => '199003122015022001',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1990-03-12',
                'alamat' => 'Jl. Malioboro No. 321, Yogyakarta',
                'no_telepon' => '081234567893',
                'email' => 'dewi.lestari@school.com',
            ],
            [
                'nama_guru' => 'Budi Santoso, M.Pd',
                'nip' => '198706182012011001',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1987-06-18',
                'alamat' => 'Jl. Asia No. 654, Medan',
                'no_telepon' => '081234567894',
                'email' => 'budi.santoso@school.com',
            ],
        ];


        foreach ($guruData as $data) {
            $user = User::create([
                'name' => $data['nama_guru'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'role_id' => $guruRole->id,
            ]);

            $guru = Guru::create([
                'nama_guru' => $data['nama_guru'],
                'nip' => $data['nip'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'alamat' => $data['alamat'],
                'no_telepon' => $data['no_telepon'],
                'user_id' => $user->id,
            ]);

            $randomKelas = collect($kelasIds)->random(rand(1, 2));
            $guru->kelas()->sync($randomKelas);
        }

        $siswaRole = Role::where('name', 'Siswa')->first();
        $kelasIds = Kelas::pluck('id')->toArray();

        $namaDepan = [
            'Ahmad',
            'Ali',
            'Andi',
            'Bayu',
            'Budi',
            'Dani',
            'Eko',
            'Fajar',
            'Hadi',
            'Indra',
            'Aisyah',
            'Ani',
            'Dewi',
            'Fitri',
            'Ika',
            'Lestari',
            'Maya',
            'Nia',
            'Putri',
            'Sari'
        ];

        $namaBelakang = [
            'Pratama',
            'Wijaya',
            'Santoso',
            'Lestari',
            'Handayani',
            'Nugraha',
            'Permana',
            'Kusuma',
            'Maharani',
            'Kurniawan',
            'Setiawan',
            'Rahayu',
            'Salsabila',
            'Ramadhan',
            'Adiputra'
        ];

        $tempatLahir = [
            'Jakarta',
            'Bandung',
            'Surabaya',
            'Medan',
            'Semarang',
            'Makassar',
            'Palembang',
            'Tangerang',
            'Depok',
            'Bekasi',
            'Bogor',
            'Yogyakarta',
            'Malang',
            'Solo',
            'Denpasar'
        ];

        for ($i = 1; $i <= 40; $i++) {
            $namaLengkap = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
            $jenisKelamin = rand(0, 1) ? 'Laki-laki' : 'Perempuan';
            $nisn = '00' . str_pad($i, 8, '0', STR_PAD_LEFT);
            $nis = str_pad($i, 5, '0', STR_PAD_LEFT);
            $email = 'siswa' . $i . '@school.com';
            $randomKelas = $kelasIds[array_rand($kelasIds)];
            $randomTempat = $tempatLahir[array_rand($tempatLahir)];

            $tahun = rand(2005, 2007);
            $bulan = rand(1, 12);
            $tanggal = rand(1, 28);
            $tanggalLahir = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tanggal);

            $user = User::create([
                'name' => $namaLengkap,
                'email' => $email,
                'password' => Hash::make('password123'),
                'role_id' => $siswaRole->id,
            ]);

            Siswa::create([
                'nama_siswa' => $namaLengkap,
                'nisn' => $nisn,
                'nis' => $nis,
                'jenis_kelamin' => $jenisKelamin,
                'tempat_lahir' => $randomTempat,
                'tanggal_lahir' => $tanggalLahir,
                'alamat' => 'Jl. ' . $namaBelakang[array_rand($namaBelakang)] . ' No. ' . rand(1, 999) . ', ' . $randomTempat,
                'no_telepon' => '0812' . rand(10000000, 99999999),
                'kelas_id' => $randomKelas,
                'user_id' => $user->id,
            ]);
        }
    }
}
