@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg bg-white p-6 shadow">
            <h3 class="text-lg font-semibold text-gray-800">Total Siswa</h3>
            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Data\Siswa::count() }}</p>
        </div>
        <div class="rounded-lg bg-white p-6 shadow">
            <h3 class="text-lg font-semibold text-gray-800">Total Kelas</h3>
            <p class="text-3xl font-bold text-red-600">{{ \App\Models\Data\Kelas::count() }}</p>
        </div>
        <div class="rounded-lg bg-white p-6 shadow">
            <h3 class="text-lg font-semibold text-gray-800">Total Guru</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Data\Guru::count() }}</p>
        </div>

    </div>

@endsection
