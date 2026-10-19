(() => {
    'use strict';
    const links = Array.from(document.querySelectorAll('[data-event-gallery]'));
    const dialog = document.getElementById('event-gallery-dialog');
    if (!links.length || !dialog || typeof dialog.showModal !== 'function') return;

    const largeImage = document.getElementById('event-gallery-large-image');
    const position = document.getElementById('event-gallery-position');
    const closeButton = dialog.querySelector('[data-event-gallery-close]');
    let current = 0;

    const showImage = (index) => {
        current = (index + links.length) % links.length;
        const thumbnail = links[current].querySelector('img');
        largeImage.src = links[current].href;
        largeImage.alt = thumbnail ? thumbnail.alt : 'ภาพกิจกรรม';
        position.textContent = 'ภาพที่ ' + (current + 1) + ' จาก ' + links.length;
    };

    links.forEach((link, index) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            showImage(index);
            dialog.showModal();
            closeButton.focus();
        });
    });
    dialog.querySelector('[data-event-gallery-previous]').addEventListener('click', () => showImage(current - 1));
    dialog.querySelector('[data-event-gallery-next]').addEventListener('click', () => showImage(current + 1));
    closeButton.addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });
    dialog.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') { event.preventDefault(); showImage(current - 1); }
        if (event.key === 'ArrowRight') { event.preventDefault(); showImage(current + 1); }
    });
    dialog.addEventListener('close', () => {
        largeImage.removeAttribute('src');
        links[current].focus();
    });
})();
