/* Disclosure navigation shared by the public pages and design preview. */
(() => {
    'use strict';
    const buttons = Array.from(document.querySelectorAll('[data-nav-disclosure]'));
    const close = (button, restoreFocus = false, suppressHover = false) => {
        button.setAttribute('aria-expanded', 'false');
        document.getElementById(button.getAttribute('aria-controls')).hidden = true;
        if (suppressHover) button.closest('.nav-disclosure').setAttribute('data-hover-suppressed', 'true');
        if (restoreFocus) button.focus();
    };
    const closeAll = () => buttons.forEach((button) => close(button));
    const open = (button) => {
        closeAll();
        button.closest('.nav-disclosure').removeAttribute('data-hover-suppressed');
        button.setAttribute('aria-expanded', 'true');
        document.getElementById(button.getAttribute('aria-controls')).hidden = false;
    };
    const desktopHover = window.matchMedia('(min-width: 1024px) and (hover: hover) and (pointer: fine)');
    buttons.forEach((button) => {
        const disclosure = button.closest('.nav-disclosure');
        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';
            if (expanded && desktopHover.matches && disclosure.matches(':hover')) return;
            closeAll();
            if (!expanded) open(button);
        });
        disclosure.addEventListener('mouseover', (event) => {
            if (desktopHover.matches && !disclosure.contains(event.relatedTarget) && !disclosure.hasAttribute('data-hover-suppressed')) open(button);
        });
        disclosure.addEventListener('mouseout', (event) => {
            if (desktopHover.matches && !disclosure.contains(event.relatedTarget)) {
                close(button);
                disclosure.removeAttribute('data-hover-suppressed');
            }
        });
        disclosure.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && button.getAttribute('aria-expanded') === 'true') {
                // Close the submenu first, before the mobile menu handles Escape.
                event.stopPropagation();
                close(button, true, true);
            }
        });
        disclosure.addEventListener('focusout', (event) => {
            if (!disclosure.contains(event.relatedTarget)) close(button, false, true);
        });
    });
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.nav-disclosure')) closeAll();
    });
    const desktop = window.matchMedia('(min-width: 1024px)');
    if (desktop.addEventListener) desktop.addEventListener('change', closeAll);
    else desktop.addListener(closeAll);
    if (desktopHover.addEventListener) desktopHover.addEventListener('change', closeAll);
    else desktopHover.addListener(closeAll);
})();
