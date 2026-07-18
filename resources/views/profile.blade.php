@extends('layouts.app')

@section('title', 'Profil Universitas')
@section('meta_description', 'Profil B University, sejarah, visi misi, pimpinan, dan staf universitas.')

@section('content')
@php
    $aboutImages = [];
    if ($aboutme && $aboutme->image) {
        $aboutImages = is_array($aboutme->image)
            ? $aboutme->image
            : (json_decode($aboutme->image, true) ?: []);
    }

    $visimisiImages = [];
    if ($visimisi && $visimisi->image) {
        $visimisiImages = is_array($visimisi->image)
            ? $visimisi->image
            : (json_decode($visimisi->image, true) ?: []);
    }
@endphp

{{-- PAGE HEADER --}}
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-20 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Profil Kampus</p>
        <h1 class="mt-3 text-4xl font-extrabold sm:text-5xl">Tentang B University</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
            Informasi lengkap mengenai profil, sejarah, visi misi, pimpinan, dan staf B University.
        </p>
    </div>
</section>

{{-- PROFIL UNIVERSITAS --}}
<section class="bg-white py-20">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Profil</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Profil Singkat Universitas</h2>

            <div class="mt-6 leading-8 text-slate-600">
                @if($aboutme)
                    <p>{{ $aboutme->content }}</p>
                @else
                    <p>Data profil universitas belum tersedia.</p>
                @endif
            </div>
        </div>

        <div>
            @if(count($aboutImages))
                <div class="grid grid-cols-2 gap-4">
                    @foreach($aboutImages as $img)
                        <img src="{{ asset('storage/' . $img) }}"
                             alt="Foto profil universitas"
                             class="h-48 w-full rounded-2xl object-cover shadow-sm">
                    @endforeach
                </div>
            @else
                <div class="flex h-72 items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-slate-50 text-slate-500">
                    Foto profil belum tersedia.
                </div>
            @endif
        </div>
    </div>
</section>

{{-- SEJARAH --}}
<section class="bg-slate-50 py-20">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div>
            @if($history && $history->image)
                <img src="{{ asset('storage/' . $history->image) }}"
                     alt="Sejarah B University"
                     class="h-[420px] w-full rounded-3xl object-cover shadow-sm">
            @else
                <div class="flex h-[420px] items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white text-slate-500">
                    Foto sejarah belum tersedia.
                </div>
            @endif
        </div>

        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Sejarah</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900">Sejarah B University</h2>

            <div class="mt-6 leading-8 text-slate-600 [&_a]:text-blue-700 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-4 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                @if($history)
                    {!! $history->content !!}
                @else
                    <p>Data sejarah belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- VISI MISI --}}
<section class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Visi & Misi</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Arah dan Tujuan Kampus</h2>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <h3 class="text-2xl font-bold text-slate-900">Visi</h3>
                <div class="mt-5 leading-8 text-slate-600 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-4 [&_ul]:list-disc [&_ul]:pl-5">
                    @if($visimisi)
                        {!! $visimisi->visi !!}
                    @else
                        <p>Data visi belum tersedia.</p>
                    @endif
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <h3 class="text-2xl font-bold text-slate-900">Misi</h3>
                <div class="mt-5 leading-8 text-slate-600 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-4 [&_ul]:list-disc [&_ul]:pl-5">
                    @if($visimisi)
                        {!! $visimisi->misi !!}
                    @else
                        <p>Data misi belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

        @if(count($visimisiImages))
            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($visimisiImages as $img)
                    <img src="{{ asset('storage/' . $img) }}"
                         alt="Foto visi misi"
                         class="h-56 w-full rounded-2xl object-cover shadow-sm">
                @endforeach
            </div>
        @endif
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
                         class="mx-auto h-32 w-32 rounded-full object-cover ring-4 ring-blue-100">

                    <h3 class="mt-5 text-lg font-bold text-slate-900">{{ $rektor->nama }}</h3>
                    <p class="mt-2 text-sm font-semibold text-blue-700">{{ $rektor->jabatan }}</p>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">
                    Data pimpinan belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ADMIN / STAF --}}
<section class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Tenaga Kependidikan</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-900 sm:text-4xl">Admin dan Staf</h2>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($admins as $admin)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 text-center shadow-sm">
                    <img src="{{ asset('storage/' . $admin->image) }}"
                         alt="{{ $admin->nama }}"
                         class="mx-auto h-24 w-24 rounded-full object-cover">

                    <h3 class="mt-4 font-bold text-slate-900">{{ $admin->nama }}</h3>
                    <p class="mt-1 text-sm text-slate-500">NIP: {{ $admin->nip }}</p>
                    <p class="mt-3 inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                        {{ $admin->jabatan }}
                    </p>
                </div>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-10 text-center text-slate-500">
                    Data admin/staf belum tersedia.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection