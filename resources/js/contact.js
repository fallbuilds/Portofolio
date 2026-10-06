export function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const submitText = document.getElementById('submit-text');
        const submitLoading = document.getElementById('submit-loading');
        const submitBtn = form.querySelector('button[type="submit"]');
        
        // Show loading
        submitText.classList.add('hidden');
        submitLoading.classList.remove('hidden');
        submitBtn.disabled = true;
        
        // Clear previous errors
        form.querySelectorAll('.error-message').forEach(el => el.remove());
        form.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
            el.classList.add('border-gray-800');
        });
        
        const formData = new FormData(form);
        
        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData,
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                showToast('success', data.message);
                form.reset();
            } else if (response.status === 422 && data.errors) {
                // Validation errors
                Object.entries(data.errors).forEach(([field, messages]) => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.remove('border-gray-800');
                        input.classList.add('border-red-500');
                        const errorEl = document.createElement('p');
                        errorEl.className = 'error-message text-red-400 text-xs mt-1';
                        errorEl.textContent = messages[0];
                        input.parentNode.appendChild(errorEl);
                    }
                });
                showToast('error', 'Mohon periksa kembali form Anda.');
            } else {
                showToast('error', data.message || 'Terjadi kesalahan. Silakan coba lagi.');
            }
        } catch (error) {
            showToast('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
        } finally {
            submitText.classList.remove('hidden');
            submitLoading.classList.add('hidden');
            submitBtn.disabled = false;
        }
    });
}

function showToast(type, message) {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'border-green-500/30 bg-green-500/10' : 'border-red-500/30 bg-red-500/10';
    const textColor = type === 'success' ? 'text-green-400' : 'text-red-400';
    const icon = type === 'success' 
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
    
    toast.className = `flex items-center gap-3 px-5 py-4 rounded-lg border backdrop-blur-sm ${bgColor} ${textColor} transform translate-x-full transition-transform duration-500 shadow-lg max-w-sm`;
    toast.innerHTML = `${icon}<span class="text-sm font-medium">${message}</span>`;
    
    container.appendChild(toast);
    
    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full');
        toast.classList.add('translate-x-0');
    });
    
    // Auto dismiss after 5 seconds
    setTimeout(() => {
        toast.classList.remove('translate-x-0');
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 500);
    }, 5000);
}
