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

function moveToEnd(imageEl) {
    const wrapper = document.getElementsByClassName('photo-wrapper')[0];

    wrapper.removeChild(imageEl);
    wrapper.appendChild(imageEl);
}

function moveToFront(imageEl) {
    const wrapper = document.getElementsByClassName('photo-wrapper')[0];
    const firstChild = wrapper.childNodes[0];

    wrapper.removeChild(imageEl);
    wrapper.insertBefore(imageEl, firstChild);
}

function displayNextImage() {
    const images = document.getElementsByClassName('mdl-card__image');
    const hidden = [].filter.call(images, image => image.offsetLeft === 0);
    const toHide = [].slice.call(images, 0, 1)[0];
    const toShow = [].slice.call(hidden, 0, 1)[0];

    toHide.style.display = 'none';
    toShow.style.display = '';
    moveToEnd(toHide);
}

function displayPrevImage() {
    const images = document.getElementsByClassName('mdl-card__image');
    const visible = [].filter.call(images, image => image.offsetLeft > 0);
    const hidden = [].filter.call(images, image => image.offsetLeft === 0);
    const toHide = [].pop.call(visible);
    const toShow = [].pop.call(hidden);

    moveToFront(toShow);
    toHide.style.display = 'none';
    toShow.style.display = '';
}

const nextBtn = document.getElementsByClassName('photo-next-btn')[0];
const prevBtn = document.getElementsByClassName('photo-prev-btn')[0];

nextBtn.addEventListener('click', () => displayNextImage());
prevBtn.addEventListener('click', () => displayPrevImage());
