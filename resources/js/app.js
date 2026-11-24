import 'bootstrap';

// Prevent double submits: lock the form on first submit.
document.addEventListener('submit', (event) => {
    const form = event.target;

    if (form.dataset.submitted === 'true') {
        event.preventDefault();
        return;
    }

    form.dataset.submitted = 'true';

    form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach((btn) => {
        btn.disabled = true;
        const label = btn.dataset.loadingText || 'Please wait...';
        if (btn.tagName === 'BUTTON') {
            btn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' + label;
        }
    });
});

// Back/forward cache: re-enable buttons if the page is restored from history.
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        window.location.reload();
    }
});
