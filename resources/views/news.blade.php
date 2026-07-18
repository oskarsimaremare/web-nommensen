@extends('layouts.app')

@section('title', 'Berita')
@section('meta_description', 'Berita dan kabar terbaru dari B University.')

@section('content')
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-20 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Kabar Kampus</p>
        <h1 class="mt-3 text-4xl font-extrabold sm:text-5xl">Berita</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
            Berita terbaru seputar kegiatan, prestasi, dan informasi kampus B University.
        </p>
    </div>
</section>

<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($news as $item)
                <article id="berita-{{ $item->id }}"
                         class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="{{ asset('storage/' . $item->image) }}"
                         alt="{{ $item->title }}"
                         class="h-56 w-full object-cover">

                    <div class="p-6">
                        <div class="mb-4 flex flex-wrap gap-2 text-xs text-slate-500">
                            <span>{{ $item->created_at?->format('d M Y') }}</span>
                            <span>•</span>
                            <span>{{ $item->user?->name ?? 'Admin' }}</span>
                        </div>

                        <h2 class="text-xl font-bold leading-snug text-slate-900">
                            {{ $item->title }}
                        </h2>

                        <p class="mt-4 leading-7 text-slate-600">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 140) }}
                        </p>

                        <details class="mt-5 rounded-2xl bg-slate-50 p-4">
                            <summary class="cursor-pointer text-sm font-bold text-blue-700 hover:text-blue-900">
                                Baca berita lengkap
                            </summary>

                            <div class="mt-5 leading-8 text-slate-700 [&_a]:text-blue-700 [&_ol]:list-decimal [&_ol]:pl-5 [&_p]:mb-4 [&_strong]:font-semibold [&_ul]:list-disc [&_ul]:pl-5">
                                {!! $item->content !!}
                            </div>
                        </details>

                        <p class="mt-5 break-all border-t border-slate-100 pt-4 text-xs text-slate-400">
                            Slug: {{ $item->slug }}
                        </p>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <h3 class="text-lg font-bold text-slate-900">Belum ada berita</h3>
                    <p class="mt-2 text-slate-500">Silakan tambahkan berita melalui panel admin Filament.</p>
                </div>
            @endforelse
        </div>

        @if($news->hasPages())
            <div class="mt-10">
                {{ $news->links() }}
            </div>
        @endif
    </div>
</section>
@endsection