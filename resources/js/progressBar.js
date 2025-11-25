export function animateProgressBar(barId, durationMs) {
    return new Promise((resolve) => {
        const progressBarContainer = document.getElementById(barId);
        if (!progressBarContainer) {
            resolve(); // resolve immediately if element not found
            return;
        }

        const progressBarFill = progressBarContainer.querySelector('.progress-bar-fill');
        if (!progressBarFill) {
            resolve();
            return;
        }

        progressBarFill.style.width = '0%';
        progressBarFill.style.backgroundColor = 'cyan';

        let startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const elapsed = timestamp - startTime;
            const progress = Math.min(elapsed / durationMs, 1);
            progressBarFill.style.width = (progress * 100) + '%';

            if (elapsed < durationMs) {
                requestAnimationFrame(step);
            } else {
                // animation complete
                resolve();
            }
        }

        requestAnimationFrame(step);
    });
}

export function clearProgress(barId){
    const progressBarContainer = document.getElementById(barId);
    if (!progressBarContainer) return;

    const progressBarFill = progressBarContainer.querySelector('.progress-bar-fill');
    if (!progressBarFill) return;
    progressBarFill.style.width = '0%';
}
