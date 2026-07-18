@extends('layouts.app')

@section('title', 'Pengumuman')
@section('meta_description', 'Daftar pengumuman resmi B University.')

@section('content')
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-20 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Informasi Resmi</p>
        <h1 class="mt-3 text-4xl font-extrabold sm:text-5xl">Pengumuman</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
            Pengumuman resmi kampus yang dikelola langsung oleh admin B University.
        </p>
    </div>
</section>

<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            @forelse($announcements as $announcement)
                <article id="pengumuman-{{ $announcement->id }}"
                         class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-lg">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">{{ $announcement->title }}</h2>

                            <div class="mt-3 flex flex-wrap gap-2 text-sm text-slate-500">
                                <span>Oleh {{ $announcement->user?->name ?? 'Admin' }}</span>
                                <span>•</span>
                                <span>{{ $announcement->created_at?->format('d M Y H:i') }}</span>
                            </div>
                        </div>

                        <span class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-xs font-bold text-blue-700">
                            Pengumuman
                        </span>
                    </div>

                    <p class="mt-5 leading-7 text-slate-600">
                        {{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 180) }}
                    </p>

                    <details class="mt-5 rounded-2xl bg-slate-50 p-5">
                        <summary class="cursor-pointer text-sm font-bold text-blue-700 hover:text-blue-900">
                            Baca isi lengkap
                        </summary>

                        <div class="mt-5 leading-8 text-slate-700 [&_a]:text-blue-700 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-4 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                            {!! $announcement->content !!}
                        </div>
                    </details>

                    <div class="mt-5 border-t border-slate-100 pt-4">
                        <p class="break-all text-xs text-slate-400">
                            Slug: {{ $announcement->slug }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <h3 class="text-lg font-bold text-slate-900">Belum ada pengumuman</h3>
                    <p class="mt-2 text-slate-500">Silakan tambahkan pengumuman melalui panel admin Filament.</p>
                </div>
            @endforelse
        </div>

        @if($announcements->hasPages())
            <div class="mt-10">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</section>
@endsection