/* Progressive enhancement only; content and search work without JavaScript. */
(() => {
    'use strict';
    const menuButton = document.getElementById('menu-toggle');
    const navigation = document.getElementById('main-nav');
    const header = document.querySelector('.site-header');
    const updateHeaderHeight = () => {
        document.documentElement.style.setProperty('--sks-header-height', `${Math.ceil(header.getBoundingClientRect().height)}px`);
    };
    updateHeaderHeight();
    if ('ResizeObserver' in window) new ResizeObserver(updateHeaderHeight).observe(header);
    else window.addEventListener('resize', updateHeaderHeight);
    const closeMenu = (restoreFocus = false) => {
        menuButton.setAttribute('aria-expanded', 'false');
        navigation.classList.remove('is-open');
        // Update before the browser follows an anchor from the expanded menu.
        updateHeaderHeight();
        if (restoreFocus) menuButton.focus();
    };
    menuButton.addEventListener('click', () => {
        const expanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', String(!expanded));
        navigation.classList.toggle('is-open', !expanded);
        updateHeaderHeight();
    });
    navigation.addEventListener('click', (event) => {
        const link = event.target.closest('a');
        if (!link) return;
        const wasExpanded = menuButton.getAttribute('aria-expanded') === 'true';
        closeMenu();
        if (wasExpanded && link.getAttribute('href').startsWith('#')) {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                target.setAttribute('tabindex', '-1');
                target.focus({ preventScroll: true });
            }
        }
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
            closeMenu(true);
        }
    });
    const desktopQuery = window.matchMedia('(min-width: 1024px)');
    const onDesktop = (event) => { if (event.matches) closeMenu(); };
    if (desktopQuery.addEventListener) desktopQuery.addEventListener('change', onDesktop);
    else desktopQuery.addListener(onDesktop);

    const cards = Array.from(document.querySelectorAll('[data-news-card]'));
    const filters = Array.from(document.querySelectorAll('[data-news-filter]'));
    filters.forEach((filter) => {
        filter.addEventListener('click', () => {
            const category = filter.dataset.newsFilter;
            filters.forEach((button) => button.setAttribute('aria-pressed', String(button === filter)));
            let visible = 0;
            cards.forEach((card) => {
                // The default presents six recent stories, with awards on demand.
                const show = category === 'all'
                    ? card.dataset.category === 'ประชาสัมพันธ์'
                    : card.dataset.category === category;
                card.hidden = !show;
                if (show) visible += 1;
            });
            document.getElementById('news-status').textContent = category === 'all'
                ? `${visible} เรื่องล่าสุด`
                : `${visible} เรื่อง · ${category}`;
        });
    });

    document.querySelectorAll('[data-carousel]').forEach((carousel) => {
        const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
        const track = carousel.querySelector('.carousel-track');
        const controls = carousel.querySelector('.carousel-controls');
        if (slides.length < 2 || !controls) return;

        const status = carousel.querySelector('[data-carousel-status]');
        const motion = window.matchMedia('(prefers-reduced-motion: reduce)');
        const canHover = window.matchMedia('(hover: hover) and (pointer: fine)');
        const interval = Number(carousel.dataset.interval) || 6000;
        let index = 0;
        let timer;
        let focused = false;
        let hovered = false;
        let inView = true;
        let touchStart;

        const schedule = () => {
            window.clearTimeout(timer);
            if (motion.matches || focused || hovered || document.hidden || !inView) return;
            timer = window.setTimeout(() => {
                show(index + 1);
                schedule();
            }, interval);
        };
        const show = (nextIndex, manual = false) => {
            index = (nextIndex + slides.length) % slides.length;
            track.style.transform = `translateX(-${index * 100}%)`;
            carousel.dataset.activeSlide = String(index);
            slides.forEach((slide, i) => {
                slide.setAttribute('aria-hidden', String(i !== index));
                const link = slide.querySelector('a');
                if (link) link.tabIndex = i === index ? 0 : -1;
            });
            if (manual) {
                status.textContent = `แบนเนอร์ ${index + 1} จาก ${slides.length}`;
                schedule();
            }
        };

        controls.hidden = false;
        carousel.dataset.activeSlide = '0';
        carousel.querySelector('[data-carousel-previous]').addEventListener('click', () => show(index - 1, true));
        carousel.querySelector('[data-carousel-next]').addEventListener('click', () => show(index + 1, true));
        carousel.addEventListener('focusin', () => { focused = true; schedule(); });
        carousel.addEventListener('focusout', () => { focused = carousel.contains(document.activeElement); schedule(); });
        carousel.addEventListener('mouseenter', () => { hovered = canHover.matches; schedule(); });
        carousel.addEventListener('mouseleave', () => { hovered = false; schedule(); });
        document.addEventListener('visibilitychange', schedule);
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(([entry]) => {
                inView = entry.isIntersecting;
                schedule();
            });
            observer.observe(carousel);
        }
        const onMotionChange = () => schedule();
        if (motion.addEventListener) motion.addEventListener('change', onMotionChange);
        else motion.addListener(onMotionChange);

        const stage = carousel.querySelector('.carousel-stage');
        stage.addEventListener('pointerdown', (event) => {
            if (event.pointerType !== 'mouse') touchStart = { x: event.clientX, y: event.clientY };
        });
        stage.addEventListener('pointercancel', () => { touchStart = null; });
        stage.addEventListener('pointerup', (event) => {
            if (!touchStart) return;
            const dx = event.clientX - touchStart.x;
            const dy = event.clientY - touchStart.y;
            touchStart = null;
            if (Math.abs(dx) > 45 && Math.abs(dx) > Math.abs(dy) * 1.5) {
                show(index + (dx < 0 ? 1 : -1), true);
            }
        });
        schedule();
    });

    document.querySelectorAll('[data-image-fallback]').forEach((image) => {
        const showFallback = () => {
            image.hidden = true;
            const fallback = image.parentElement.querySelector('.image-fallback');
            if (fallback) fallback.hidden = false;
        };
        image.addEventListener('error', showFallback);
        if (image.complete && image.naturalWidth === 0) showFallback();
    });

    const resultsHeading = document.getElementById('results-title');
    if (resultsHeading && window.location.hash === '#search-results') {
        resultsHeading.focus({ preventScroll: true });
    }
})();
