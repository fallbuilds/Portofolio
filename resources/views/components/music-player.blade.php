<div id="listening-room" class="fixed bottom-6 left-6 z-[90] w-80 bg-dark-900/90 backdrop-blur-xl border border-gray-800/60 rounded-2xl shadow-[0_8px_32px_rgba(0,0,0,0.5)] transform translate-y-full opacity-0 invisible transition-all duration-500 overflow-hidden">
    <!-- Header -->
    <div class="px-5 py-4 border-b border-gray-800/60 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-accent-cyan animate-pulse"></span>
            <span class="text-xs font-mono tracking-widest text-accent-cyan uppercase">Listening Room</span>
        </div>
        <button id="close-player-btn" class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-white transition-colors" aria-label="Close">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <div class="p-5">
        <!-- Now Playing Card -->
        <div class="flex items-center gap-4 mb-6 p-3 bg-dark-800/50 rounded-xl border border-gray-800/40">
            <div class="w-14 h-14 rounded-lg bg-dark-900 overflow-hidden shrink-0 border border-gray-700/50 relative">
                <!-- Cover Image -->
                <img id="player-cover" src="{{ asset('images/profile-1.png') }}" class="w-full h-full object-cover opacity-80" alt="Cover">
                <div class="absolute inset-0 bg-accent-cyan/10"></div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-0.5">
                    <p id="player-title" class="text-white font-bold truncate text-sm">bye (slowed)</p>
                    <!-- Equalizer Animation (Hidden when paused) -->
                    <div id="player-eq" class="flex items-end gap-0.5 h-3 opacity-0 transition-opacity">
                        <div class="w-0.5 bg-accent-cyan animate-[eq_0.8s_ease-in-out_infinite] origin-bottom h-full"></div>
                        <div class="w-0.5 bg-accent-cyan animate-[eq_1.2s_ease-in-out_infinite_0.2s] origin-bottom h-full"></div>
                        <div class="w-0.5 bg-accent-cyan animate-[eq_0.9s_ease-in-out_infinite_0.4s] origin-bottom h-full"></div>
                    </div>
                </div>
                <p id="player-artist" class="text-gray-400 text-xs truncate">Altare</p>
            </div>
        </div>

        <!-- Progress -->
        <div class="mb-5">
            <div class="relative h-1.5 bg-gray-800 rounded-full overflow-hidden group cursor-pointer" id="progress-container">
                <div id="progress-bar" class="absolute top-0 left-0 h-full bg-accent-cyan w-0"></div>
            </div>
            <div class="flex justify-between mt-2 text-[10px] font-mono text-gray-500">
                <span id="time-current">0:00</span>
                <span id="time-total">0:00</span>
            </div>
        </div>

        <!-- Controls -->
        <div class="flex items-center justify-between mb-6">
            <button id="btn-prev" class="text-gray-400 hover:text-white transition-colors p-2">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/></svg>
            </button>
            
            <button id="btn-play" class="w-12 h-12 bg-accent-cyan text-dark-900 rounded-full flex items-center justify-center hover:bg-white hover:scale-105 transition-all shadow-[0_0_15px_rgba(0,245,255,0.3)] pl-1">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </button>

            <button id="btn-next" class="text-gray-400 hover:text-white transition-colors p-2">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/></svg>
            </button>
            
            <div class="flex items-center gap-2 w-20">
                <svg class="w-4 h-4 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
                <div class="relative h-1 bg-gray-800 rounded-full w-full cursor-pointer" id="volume-container">
                    <div id="volume-bar" class="absolute top-0 left-0 h-full bg-accent-cyan w-[80%]"></div>
                    <div id="volume-handle" class="absolute top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-white rounded-full left-[80%] -ml-1.5 shadow"></div>
                </div>
            </div>
        </div>

        <!-- Playlist -->
        <div class="border-t border-gray-800/60 pt-4">
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center gap-2 text-xs font-mono text-gray-400 uppercase">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                    Query
                </div>
                <span class="text-[10px] font-mono text-gray-600">2 TRACKS</span>
            </div>

            <div class="space-y-1 max-h-32 overflow-y-auto pr-1 scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-transparent">
                <!-- Track 1 -->
                <button class="playlist-item w-full flex items-center justify-between p-2 rounded-lg bg-dark-800/30 border border-gray-700/50 hover:bg-dark-800 transition-colors group text-left" data-index="0">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <span class="text-xs font-mono text-gray-500 w-4">01</span>
                        <div class="truncate">
                            <p class="text-sm font-medium text-white truncate group-hover:text-accent-cyan transition-colors">Teh Hijau (Acoustic Chill)</p>
                            <p class="text-[10px] text-gray-500 font-mono">Lofi Vibes</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="text-[10px] font-mono text-gray-600">2:26</span>
                        <svg class="w-4 h-4 text-accent-cyan opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </button>

                <!-- Track 2 -->
                <button class="playlist-item w-full flex items-center justify-between p-2 rounded-lg hover:bg-dark-800 border border-transparent hover:border-gray-700/50 transition-colors group text-left" data-index="1">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <span class="text-xs font-mono text-gray-500 w-4">02</span>
                        <div class="truncate">
                            <p class="text-sm font-medium text-gray-300 truncate group-hover:text-accent-cyan transition-colors">Kopi Malam (Slowed)</p>
                            <p class="text-[10px] text-gray-500 font-mono">Midnight</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="text-[10px] font-mono text-gray-600">3:18</span>
                        <svg class="w-4 h-4 text-accent-cyan opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Audio Element -->
    <audio id="audio-player" preload="metadata"></audio>
</div>

<!-- Floating Trigger Button -->
<button id="toggle-player-btn" class="fixed bottom-6 left-6 z-[80] w-12 h-12 bg-dark-900/80 backdrop-blur-sm border border-accent-cyan/30 rounded-full flex items-center justify-center text-accent-cyan hover:bg-accent-cyan hover:text-dark-900 hover:scale-110 transition-all duration-300 shadow-[0_0_15px_rgba(0,245,255,0.2)] group" aria-label="Open Music Player">
    <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
</button>

<style>
@keyframes eq {
    0%, 100% { transform: scaleY(0.2); }
    50% { transform: scaleY(1); }
}
</style>
