document.addEventListener('DOMContentLoaded', () => {
    const rows = document.querySelectorAll('tr[data-id]');
    const modal = document.getElementById('viewEmail');
    const modalTitle = modal.querySelector('.modal-title');
    const subject = modal.querySelector('#emailSubject');
    const recipientsList = modal.querySelector('#emailRecipients');
    const body = modal.querySelector('#emailBody');
    const created = modal.querySelector('#emailCreated');

    rows.forEach(row => {
        row.addEventListener('click', () => {
            const id = row.dataset.id;
            const title = row.dataset.title;
            const emailBody = row.dataset.body;
            const createdAt = row.dataset.created;
            const recipients = JSON.parse(row.dataset.emails || '[]');

            modalTitle.textContent = `#${id} — ${title}`;
            subject.textContent = title;

            recipientsList.innerHTML = recipients.map(mail => `<li>${mail}</li>`).join('');
            body.innerHTML = emailBody;
            created.textContent = createdAt;
        });
    });
});
