/**
 * Background Music Player using HTML5 Audio
 */

let bgMusic = null;
let isPlaying = false;

function initAudioPlayer() {
    if (!bgMusic) {
        bgMusic = new Audio('/audio/bgm.mp3');
        bgMusic.loop = true;
        bgMusic.volume = 0.5; // 50% volume
    }
}

export function initAudioToggle() {
    const btn = document.getElementById('sound-toggle-btn');
    if (!btn) return;

    btn.addEventListener('click', () => {
        initAudioPlayer();
        
        if (isPlaying) {
            bgMusic.pause();
            isPlaying = false;
        } else {
            // Play returns a promise which might be rejected if blocked by browser policy
            const playPromise = bgMusic.play();
            if (playPromise !== undefined) {
                playPromise.then(() => {
                    isPlaying = true;
                    updateUI();
                }).catch(error => {
                    console.error("Audio playback failed:", error);
                    alert("Gagal memutar audio. Pastikan file /audio/bgm.mp3 tersedia.");
                    isPlaying = false;
                    updateUI();
                });
            } else {
                isPlaying = true;
            }
        }
        
        updateUI();
    });

    function updateUI() {
        const iconOn = btn.querySelector('.sound-on');
        const iconOff = btn.querySelector('.sound-off');

        if (iconOn && iconOff) {
            iconOn.classList.toggle('hidden', !isPlaying);
            iconOff.classList.toggle('hidden', isPlaying);
        }

        btn.classList.toggle('text-accent-cyan', isPlaying);
        btn.classList.toggle('border-accent-cyan/40', isPlaying);
    }
}
