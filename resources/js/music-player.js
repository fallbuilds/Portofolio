export function initMusicPlayer() {
    const toggleBtn = document.getElementById('toggle-player-btn');
    const playerModal = document.getElementById('listening-room');
    const closeBtn = document.getElementById('close-player-btn');
    
    if (!toggleBtn || !playerModal) return;

    // UI Elements
    const audio = document.getElementById('audio-player');
    const playBtn = document.getElementById('btn-play');
    const prevBtn = document.getElementById('btn-prev');
    const nextBtn = document.getElementById('btn-next');
    const titleEl = document.getElementById('player-title');
    const artistEl = document.getElementById('player-artist');
    // const coverEl = document.getElementById('player-cover'); // If we have different covers
    const eqAnim = document.getElementById('player-eq');
    
    // Progress
    const progressContainer = document.getElementById('progress-container');
    const progressBar = document.getElementById('progress-bar');
    const timeCurrent = document.getElementById('time-current');
    const timeTotal = document.getElementById('time-total');
    
    // Volume
    const volContainer = document.getElementById('volume-container');
    const volBar = document.getElementById('volume-bar');
    const volHandle = document.getElementById('volume-handle');
    
    // Playlist
    const playlistItems = document.querySelectorAll('.playlist-item');

    // Playlist Data
    const playlist = [
        {
            title: 'bye (slowed)',
            artist: 'Altare',
            src: 'https://cdn.pixabay.com/download/audio/2022/03/15/audio_2c270dc844.mp3?filename=lofi-study-112191.mp3', // Placeholder chill track
            cover: '/images/profile-1.png'
        },
        {
            title: 'worry (ultra slowed)',
            artist: 'LONOWN',
            src: 'https://cdn.pixabay.com/download/audio/2022/10/25/audio_6506f0e637.mp3?filename=empty-mind-122976.mp3', // Placeholder ambient track
            cover: '/images/profile-2.png'
        }
    ];

    let currentTrackIndex = 0;
    let isPlaying = false;

    // Toggle Modal
    const toggleModal = () => {
        const isOpen = !playerModal.classList.contains('translate-y-full');
        if (isOpen) {
            playerModal.classList.add('translate-y-full', 'opacity-0', 'invisible');
            playerModal.classList.remove('translate-y-0', 'opacity-100', 'visible');
        } else {
            playerModal.classList.remove('translate-y-full', 'opacity-0', 'invisible');
            playerModal.classList.add('translate-y-0', 'opacity-100', 'visible');
        }
    };

    toggleBtn.addEventListener('click', toggleModal);
    closeBtn.addEventListener('click', toggleModal);

    // Load Track
    const loadTrack = (index) => {
        currentTrackIndex = index;
        const track = playlist[index];
        audio.src = track.src;
        titleEl.textContent = track.title;
        artistEl.textContent = track.artist;
        // coverEl.src = track.cover;
        
        // Update active class on playlist
        playlistItems.forEach((item, i) => {
            const isMatch = i === index;
            item.classList.toggle('bg-dark-800', isMatch);
            item.classList.toggle('border-accent-cyan/30', isMatch);
            const icon = item.querySelector('svg');
            if (icon) {
                icon.style.opacity = isMatch && isPlaying ? '1' : '0';
            }
        });
        
        if (isPlaying) {
            audio.play();
        }
    };

    // Play/Pause
    const togglePlay = () => {
        if (audio.src === '') {
            loadTrack(0);
        }
        if (isPlaying) {
            audio.pause();
        } else {
            audio.play();
        }
    };

    playBtn.addEventListener('click', togglePlay);

    // Audio Event Listeners
    audio.addEventListener('play', () => {
        isPlaying = true;
        playBtn.innerHTML = '<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>';
        eqAnim.classList.remove('opacity-0');
        updatePlaylistIcons();
    });

    audio.addEventListener('pause', () => {
        isPlaying = false;
        playBtn.innerHTML = '<svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>';
        eqAnim.classList.add('opacity-0');
        updatePlaylistIcons();
    });

    audio.addEventListener('ended', () => {
        nextTrack();
    });

    const updatePlaylistIcons = () => {
        playlistItems.forEach((item, i) => {
            const icon = item.querySelector('svg');
            if (icon) {
                icon.style.opacity = (i === currentTrackIndex && isPlaying) ? '1' : '0';
            }
        });
    };

    // Prev/Next
    const prevTrack = () => {
        let newIndex = currentTrackIndex - 1;
        if (newIndex < 0) newIndex = playlist.length - 1;
        const wasPlaying = isPlaying;
        loadTrack(newIndex);
        if (wasPlaying) audio.play();
    };

    const nextTrack = () => {
        let newIndex = currentTrackIndex + 1;
        if (newIndex >= playlist.length) newIndex = 0;
        const wasPlaying = isPlaying;
        loadTrack(newIndex);
        if (wasPlaying) audio.play();
    };

    prevBtn.addEventListener('click', prevTrack);
    nextBtn.addEventListener('click', nextTrack);

    // Format Time
    const formatTime = (seconds) => {
        if (isNaN(seconds)) return '0:00';
        const m = Math.floor(seconds / 60);
        const s = Math.floor(seconds % 60);
        return `${m}:${s < 10 ? '0' : ''}${s}`;
    };

    // Update Progress
    audio.addEventListener('timeupdate', () => {
        const { currentTime, duration } = audio;
        if (duration) {
            const percent = (currentTime / duration) * 100;
            progressBar.style.width = `${percent}%`;
            timeCurrent.textContent = formatTime(currentTime);
            timeTotal.textContent = formatTime(duration);
        }
    });

    // Seek
    progressContainer.addEventListener('click', (e) => {
        const width = progressContainer.clientWidth;
        const clickX = e.offsetX;
        const duration = audio.duration;
        if (duration) {
            audio.currentTime = (clickX / width) * duration;
        }
    });

    // Volume
    audio.volume = 0.8; // default
    
    const setVolume = (e) => {
        const width = volContainer.clientWidth;
        let clickX = e.offsetX;
        
        // Handle dragging
        if (e.type === 'mousemove' && e.buttons !== 1) return;
        
        if (e.target === volHandle) {
           const rect = volContainer.getBoundingClientRect();
           clickX = e.clientX - rect.left;
        }

        let percent = clickX / width;
        if (percent < 0) percent = 0;
        if (percent > 1) percent = 1;
        
        audio.volume = percent;
        volBar.style.width = `${percent * 100}%`;
        volHandle.style.left = `${percent * 100}%`;
    };

    volContainer.addEventListener('mousedown', setVolume);
    volContainer.addEventListener('mousemove', setVolume);

    // Playlist Clicks
    playlistItems.forEach((item) => {
        item.addEventListener('click', () => {
            const index = parseInt(item.dataset.index);
            if (index === currentTrackIndex) {
                togglePlay();
            } else {
                isPlaying = true;
                loadTrack(index);
                audio.play();
            }
        });
    });

    // Initial load
    loadTrack(0);
}
