@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Website resmi B University — informasi profil, dosen, fasilitas, pengumuman, dan berita kampus.')

@section('content')
@php
    $aboutImages = [];
    if ($aboutme && $aboutme->image) {
        $aboutImages = is_array($aboutme->image)
            ? $aboutme->image
            : (json_decode($aboutme->image, true) ?: []);
    }

    $heroImage = $aboutImages[0] ?? null;
@endphp

{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-slate-900 text-white">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-blue-300 blur-3xl"></div>
    </div>

    <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-28">
        <div>
            <span class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-blue-100 ring-1 ring-white/20">
                Website Resmi Kampus
            </span>

            <h1 class="mt-6 text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                B University
            </h1>

            <p class="mt-6 max-w-2xl text-lg leading-8 text-blue-100">
                {{ \Illuminate\Support\Str::limit(strip_tags($aboutme->content ?? 'B University adalah institusi pendidikan tinggi yang berkomitmen menghasilkan lulusan unggul, adaptif, dan siap menghadapi perkembangan teknologi.'), 190) }}
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('profile') }}"
                   class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-blue-900 shadow-lg transition hover:bg-blue-50">
                    Lihat Profil Kampus
                </a>

                <a href="{{ route('lectures') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-white/30 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">
                    Lihat Data Dosen
                </a>
            </div>

            <div class="mt-10 grid grid-cols-3 gap-4 border-t border-white/20 pt-8">
                <div>
                    <p class="text-3xl font-extrabold">{{ $facilities->count() }}</p>
                    <p class="mt-1 text-sm text-blue-100">Fasilitas</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold">{{ $cooperations->count() }}</p>
                    <p class="mt-1 text-sm text-blue-100">Kerja Sama</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold">{{ $rektors->count() }}</p>
                    <p class="mt-1 text-sm text-blue-100">Pimpinan</p>
                </div>
            </div>
        </div>

        <div class="relative">
            @if($heroImage)
                <img src="{{ asset('storage/' . $heroImage) }}"
                     alt="B University"
                     class="h-[420px] w-full rounded-3xl object-cover shadow-2xl ring-1 ring-white/20">
            @else
                <div class="flex h-[420px] w-full items-center justify-center rounded-3xl bg-white/10 shadow-2xl ring-1 ring-white/20">
                    <div class="text-center">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-white/20 text-3xl font-black">
                            BU
                        </div>
                        <p class="mt-4 text-blue-100">Foto kampus belum tersedia</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- LOGO KERJA SAMA --}}
<section class="border-b border-slate-100 bg-white py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col justify-between gap-2 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Kerja Sama</p>
                <h2 class="mt-2 text-2xl font-bold text-slate-900">Mitra dan Kolaborasi</h2>
            </div>
            <a href="{{ route('profile') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900">
                Tentang kampus →
            </a>
        </div>

        @if($cooperations->count())
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                @foreach($cooperations as $cooperation)
                    <div class="flex h-24 items-center justify-center rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <img src="{{ asset('storage/' . $cooperation->image) }}"
                             alt="Logo kerja sama"
                             class="max-h-14 w-auto object-contain">
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-slate-300 p-8 text-center text-slate-500">
                Data kerja sama belum tersedia.
            </div>
        @endif
    </div>
</section>

{{-- PROFIL SINGKAT & SAMBUTAN --}}
<section class="bg-slate-50 py-20">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Profil Singkat</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Tentang B University</h2>

            <p class="mt-5 leading-8 text-slate-600">
                {{ $aboutme->content ?? 'Profil singkat universitas belum tersedia. Silakan lengkapi data melalui CMS.' }}
            </p>

            <div class="mt-6">
                <a href="{{ route('profile') }}"
                   class="inline-flex rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-800">
                    Baca Profil Lengkap
                </a>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Sambutan</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Sambutan Pimpinan</h2>

            @if($greeting)
                <div class="mt-6 flex flex-col gap-6 sm:flex-row">
                    <img src="{{ asset('storage/' . $greeting->image) }}"
                         alt="Sambutan pimpinan"
                         class="h-32 w-32 rounded-2xl object-cover shadow-sm">

                    <div class="leading-8 text-slate-600 [&_a]:text-blue-700 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-3 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                        {!! \Illuminate\Support\Str::limit(strip_tags($greeting->content), 280) !!}
                    </div>
                </div>
            @else
                <p class="mt-6 text-slate-500">Data sambutan belum tersedia.</p>
            @endif
        </div>
    </div>
</section>

{{-- FASILITAS --}}
<section class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Fasilitas</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Fasilitas Kampus</h2>
            <p class="mt-4 text-slate-600">
                Fasilitas pendukung pembelajaran dan pengembangan kompetensi mahasiswa.
            </p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($facilities as $facility)
                <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ asset('storage/' . $facility->image) }}"
                         alt="Fasilitas kampus"
                         class="h-56 w-full object-cover">

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900">Fasilitas Kampus</h3>
                        <p class="mt-3 leading-7 text-slate-600">
                            {{ \Illuminate\Support\Str::limit(strip_tags($facility->content), 140) }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">
                    Data fasilitas belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- VISI MISI --}}
<section class="bg-blue-950 py-20 text-white">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Arah Kampus</p>
            <h2 class="mt-3 text-3xl font-bold sm:text-4xl">Visi dan Misi</h2>
            <p class="mt-4 text-blue-100">
                Komitmen B University dalam penyelenggaraan pendidikan tinggi.
            </p>
        </div>

        <div class="grid gap-6">
            <div class="rounded-3xl bg-white/10 p-6 ring-1 ring-white/15">
                <h3 class="text-xl font-bold">Visi</h3>
                <div class="mt-4 leading-8 text-blue-50 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-5">
                    @if($visimisi)
                        {!! $visimisi->visi !!}
                    @else
                        <p>Data visi belum tersedia.</p>
                    @endif
                </div>
            </div>

            <div class="rounded-3xl bg-white/10 p-6 ring-1 ring-white/15">
                <h3 class="text-xl font-bold">Misi</h3>
                <div class="mt-4 leading-8 text-blue-50 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-5">
                    @if($visimisi)
                        {!! $visimisi->misi !!}
                    @else
                        <p>Data misi belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PIMPINAN --}}
<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Pimpinan</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Pimpinan Universitas</h2>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($rektors as $rektor)
                <div class="rounded-3xl bg-white p-6 text-center shadow-sm ring-1 ring-slate-200">
                    <img src="{{ asset('storage/' . $rektor->image) }}"
                         alt="{{ $rektor->nama }}"
                         class="mx-auto h-28 w-28 rounded-full object-cover ring-4 ring-blue-100">

                    <h3 class="mt-5 text-lg font-bold text-slate-900">{{ $rektor->nama }}</h3>
                    <p class="mt-2 rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">
                        {{ $rektor->jabatan }}
                    </p>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">
                    Data pimpinan belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- PENGUMUMAN & BERITA TERBARU --}}
<section class="bg-white py-20">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div>
            <div class="mb-6 flex items-end justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Informasi</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">Pengumuman Terbaru</h2>
                </div>
                <a href="{{ route('announcements') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900">
                    Lihat semua →
                </a>
            </div>

            <div class="space-y-4">
                @forelse($latestAnnouncements as $announcement)
                    <article class="rounded-2xl border border-slate-200 p-5 transition hover:border-blue-200 hover:bg-blue-50/40">
                        <h3 class="font-bold text-slate-900">{{ $announcement->title }}</h3>
                        <p class="mt-2 text-sm text-slate-600">
                            {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 120) }}
                        </p>
                        <p class="mt-3 text-xs text-slate-500">
                            Oleh {{ $announcement->user?->name ?? 'Admin' }} • {{ $announcement->created_at?->format('d M Y') }}
                        </p>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 p-8 text-center text-slate-500">
                        Belum ada pengumuman.
                    </div>
                @endforelse
            </div>
        </div>

        <div>
            <div class="mb-6 flex items-end justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Kabar Kampus</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">Berita Terbaru</h2>
                </div>
                <a href="{{ route('news') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900">
                    Lihat semua →
                </a>
            </div>

            <div class="space-y-4">
                @forelse($latestNews as $item)
                    <article class="flex gap-4 rounded-2xl border border-slate-200 p-4 transition hover:border-blue-200 hover:bg-blue-50/40">
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ $item->title }}"
                             class="h-24 w-24 rounded-xl object-cover">

                        <div>
                            <h3 class="font-bold text-slate-900">{{ $item->title }}</h3>
                            <p class="mt-2 text-sm text-slate-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 90) }}
                            </p>
                            <p class="mt-2 text-xs text-slate-500">
                                Oleh {{ $item->user?->name ?? 'Admin' }} • {{ $item->created_at?->format('d M Y') }}
                            </p>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 p-8 text-center text-slate-500">
                        Belum ada berita.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-5xl rounded-3xl bg-gradient-to-br from-blue-700 to-blue-950 px-6 py-14 text-center text-white shadow-xl sm:px-10">
        <h2 class="text-3xl font-bold sm:text-4xl">Siap Mengenal B University Lebih Dekat?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-blue-100">
            Jelajahi profil, data dosen, pengumuman, berita, dan informasi kampus lainnya melalui website resmi ini.
        </p>
        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
            <a href="{{ route('profile') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-bold text-blue-900 hover:bg-blue-50">
                Lihat Profil
            </a>
            <a href="{{ route('news') }}" class="rounded-xl border border-white/30 px-6 py-3 text-sm font-bold text-white hover:bg-white/10">
                Baca Berita
            </a>
        </div>
    </div>
</section>
@endsection