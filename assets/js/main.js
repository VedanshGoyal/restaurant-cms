import 'mdl';

const navDrawer = document.getElementsByClassName('mdl-layout__drawer')[0];
const navLinks = navDrawer.getElementsByClassName('mdl-navigation__link');

[].forEach.call(navLinks, link => {
    link.addEventListener('click', () => {
        if (navDrawer.classList.contains('is-visible')) {
            document.getElementsByClassName('mdl-layout__obfuscator')[0].dispatchEvent(new Event('click'));
        }
    });
});
