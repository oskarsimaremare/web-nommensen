@extends('layouts.app')

@section('title', 'Daftar Dosen')
@section('meta_description', 'Daftar dosen B University beserta NIDN, jabatan, email, dan topik keahlian.')

@section('content')
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-20 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Akademik</p>
        <h1 class="mt-3 text-4xl font-extrabold sm:text-5xl">Daftar Dosen</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
            Informasi dosen B University beserta bidang keahlian dan kontak akademik.
        </p>
    </div>
</section>

<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Dosen B University</h2>
                <p class="mt-2 text-slate-600">Data diambil langsung dari CMS Filament.</p>
            </div>

            <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-slate-200">
                Total tampil: {{ $lectures->count() }} data
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($lectures as $lecture)
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start gap-5">
                        <img src="{{ asset('storage/' . $lecture->image) }}"
                             alt="{{ $lecture->nama }}"
                             class="h-24 w-24 rounded-2xl object-cover ring-4 ring-blue-50">

                        <div class="min-w-0">
                            <h3 class="text-lg font-bold text-slate-900">{{ $lecture->nama }}</h3>
                            <p class="mt-1 text-sm text-slate-500">NIDN: {{ $lecture->nidn }}</p>
                            <span class="mt-3 inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                {{ $lecture->jabatan }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3 border-t border-slate-100 pt-5 text-sm">
                        <div>
                            <p class="font-semibold text-slate-900">Pendidikan</p>
                            <p class="mt-1 text-slate-600">{{ $lecture->pendidikan }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-slate-900">Topik Keahlian</p>
                            <p class="mt-1 text-slate-600">{{ $lecture->topik }}</p>
                        </div>

                        <div>
                            <p class="font-semibold text-slate-900">Email</p>
                            <a href="mailto:{{ $lecture->email }}"
                               class="mt-1 inline-block break-all text-blue-700 hover:text-blue-900">
                                {{ $lecture->email }}
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <h3 class="text-lg font-bold text-slate-900">Data dosen belum tersedia</h3>
                    <p class="mt-2 text-slate-500">Silakan tambahkan data dosen melalui panel admin Filament.</p>
                </div>
            @endforelse
        </div>

        @if($lectures->hasPages())
            <div class="mt-10">
                {{ $lectures->links() }}
            </div>
        @endif
    </div>
</section>
@endsection