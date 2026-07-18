@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('meta_description', 'Data mahasiswa B University berdasarkan input dari CMS.')

@section('content')
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-20 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Mahasiswa</p>
        <h1 class="mt-3 text-4xl font-extrabold sm:text-5xl">Data Mahasiswa</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
            Data mahasiswa yang telah dikelola melalui admin panel B University.
        </p>
    </div>
</section>

<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Mahasiswa Terdaftar</h2>
                <p class="mt-2 text-slate-600">Informasi mahasiswa dan pilihan program studi.</p>
            </div>

            <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200">
                Total tampil: {{ $students->count() }} data
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($students as $student)
                @php
                    $badgeClass = match ($student->jalur) {
                        'Reguler' => 'bg-blue-50 text-blue-700',
                        'Beasiswa' => 'bg-emerald-50 text-emerald-700',
                        'Transfer' => 'bg-amber-50 text-amber-700',
                        default => 'bg-slate-100 text-slate-700',
                    };
                @endphp

                <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ asset('storage/' . $student->image) }}"
                         alt="{{ $student->namalengkap }}"
                         class="h-56 w-full object-cover">

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-bold text-slate-900">{{ $student->namalengkap }}</h3>
                                <p class="mt-1 text-sm text-slate-500">Panggilan: {{ $student->namapanggilan }}</p>
                            </div>

                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $badgeClass }}">
                                {{ $student->jalur }}
                            </span>
                        </div>

                        <div class="mt-5 space-y-3 text-sm">
                            <div>
                                <p class="font-semibold text-slate-900">Email</p>
                                <a href="mailto:{{ $student->email }}" class="break-all text-blue-700 hover:text-blue-900">
                                    {{ $student->email }}
                                </a>
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">Nomor HP</p>
                                <p class="text-slate-600">{{ $student->nomor_hp }}</p>
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">Pilihan Program Studi</p>
                                <ul class="mt-1 space-y-1 text-slate-600">
                                    <li>1. {{ $student->programstudi_1 }}</li>
                                    <li>2. {{ $student->programstudi_2 }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <h3 class="text-lg font-bold text-slate-900">Data mahasiswa belum tersedia</h3>
                    <p class="mt-2 text-slate-500">Silakan tambahkan data mahasiswa melalui panel admin Filament.</p>
                </div>
            @endforelse
        </div>

        @if($students->hasPages())
            <div class="mt-10">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</section>
@endsection