document.addEventListener('DOMContentLoaded', () => {

    const rows = document.querySelectorAll('tr[data-id]');
    const modal = document.getElementById('viewEmail');
    const modalTitle = modal.querySelector('.modal-title');
    const modalBody = modal.querySelector('.modal-body');

    rows.forEach(row => {
        row.addEventListener('click', () => {
            const id = row.dataset.id;
            const title = row.dataset.title;
            const body = row.dataset.body;
            const emails = row.dataset.emails;
            const created = row.dataset.created;
            modalTitle.textContent = `#${id} — ${title}`;
            modalBody.innerHTML = `
                <p><strong>Tárgy:</strong> ${title}</p>
                <p><strong>Címzettek:</strong> ${emails}</p>
                <p><strong>Szöveg:</strong></p>
                <div class="border rounded p-2 mb-3 bg-light">${body}</div>
                <p><strong>Küldés ideje:</strong> ${created}</p>
            `;
        });
    });
});
