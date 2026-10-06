@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-dark-900 text-gray-100 py-12 px-6 lg:px-12">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 pb-6 border-b border-gray-800">
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-accent-cyan hover:underline mb-2 font-mono">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Portfolio
                </a>
                <h1 class="text-3xl font-heading font-bold text-white">Contact <span class="text-accent-cyan">Inquiries</span></h1>
                <p class="text-gray-500 text-sm mt-1">Daftar pesan masuk yang dikirimkan melalui form kontak website.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-accent-cyan/10 border border-accent-cyan/30 text-accent-cyan text-xs font-mono rounded-full">
                    Total: {{ $messages->total() }} Pesan
                </span>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-500/10 border border-green-500/30 text-green-400 text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Messages List -->
        @if($messages->isEmpty())
        <div class="text-center py-24 border border-dashed border-gray-800 rounded-2xl">
            <div class="w-16 h-16 rounded-full bg-dark-800 flex items-center justify-center text-gray-500 mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h3 class="text-lg font-heading font-medium text-gray-300 mb-1">Belum ada pesan masuk</h3>
            <p class="text-gray-500 text-sm">Pesan yang dikirim melalui formulir kontak akan tampil di sini.</p>
        </div>
        @else
        <div class="space-y-4">
            @foreach($messages as $msg)
            <div class="bg-dark-800/40 border border-gray-800/80 rounded-xl p-6 hover:border-accent-cyan/30 transition-all backdrop-blur-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-3">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-accent-cyan animate-pulse"></span>
                        <h3 class="text-lg font-heading font-bold text-white">{{ $msg->name }}</h3>
                        <a href="mailto:{{ $msg->email }}" class="text-xs text-gray-400 hover:text-accent-cyan font-mono transition-colors">
                            &lt;{{ $msg->email }}&gt;
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xs text-gray-500 font-mono">{{ $msg->created_at->diffForHumans() }}</span>
                        <form action="{{ route('messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-400 p-1 transition-colors" title="Hapus pesan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mb-3">
                    <span class="text-xs px-2.5 py-0.5 rounded bg-dark-700 text-accent-cyan font-mono border border-gray-700/50">
                        {{ $msg->subject }}
                    </span>
                </div>

                <p class="text-gray-300 text-sm leading-relaxed bg-dark-900/60 p-4 rounded-lg border border-gray-800/60 font-sans whitespace-pre-wrap">{{ $msg->message }}</p>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
