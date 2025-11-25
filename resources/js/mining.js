import {animateProgressBar, clearProgress} from './progressBar.js'
async function showTemporaryMessage(container, message, type = 'info'){
    const msg = document.createElement('div');
    msg.className = `mt-2 px-3 py-2 rounded text-sm ${type === 'error' ? 'bg-red-100 text-red-800' : type === 'success' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}`;
    msg.textContent = message;
    container.appendChild(msg);
    setTimeout(() => msg.remove(), 4000);
}

async function startMining(form, barId, durationMs, button){
    try{
        button.disabled = true;
        await animateProgressBar(barId, durationMs);
        clearProgress(barId);

        // Submit via AJAX to avoid a full page reload (which re-fetches CSS/JS assets)
        try {
            const tokenInput = form.querySelector('input[name="_token"]');
            const token = tokenInput ? tokenInput.value : (document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : null);

            const headers = {
                'X-Requested-With': 'XMLHttpRequest',
            };
            if (token) headers['X-CSRF-TOKEN'] = token;

            const body = new URLSearchParams(new FormData(form));

            const resp = await fetch(form.action, {
                method: 'POST',
                headers,
                body,
                credentials: 'same-origin',
            });

            if (!resp.ok) {
                const txt = await resp.text();
                console.error('Mining request failed', resp.status, txt);
                await showTemporaryMessage(form, 'Failed to mine item. Try again.', 'error');
            } else {
                // success: show confirmation without reloading page
                await showTemporaryMessage(form, 'Mining complete! Item added to inventory.', 'success');
            }
        } catch (err) {
            console.error('Network error while submitting mine request', err);
            await showTemporaryMessage(form, 'Network error. Try again.', 'error');
        }

    } finally {
        // ensure button is re-enabled after the request completes
        button.disabled = false;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const coalButton = document.getElementById('coalButton')
    const coalForm = document.getElementById('mineCoalForm')
    coalButton.addEventListener('click', async() => {
        const duration = parseInt(coalForm.dataset.durationSeconds, 10) || 9;
        await startMining(coalForm, 'coalBar', duration * 1000, coalButton);
        console.log('complete')
    });
    const tinButton = document.getElementById('tinButton')
    const tinForm = document.getElementById('mineTinForm')
    tinButton.addEventListener('click', async() => {
        const duration = parseInt(tinForm.dataset.durationSeconds, 10) || 11;
        await startMining(tinForm, 'tinBar', duration * 1000, tinButton);
        console.log('complete')
    });
});
