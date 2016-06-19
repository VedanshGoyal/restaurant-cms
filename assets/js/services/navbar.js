import $ from 'jquery';
import _ from 'underscore';

class NavBarService {
    constructor() {
        this.drawer = $('div.navigation');
        this.nav = this.drawer.find('nav.navigation').first();
        this.contentLinks = this.nav.find('.content-links');
        this.authLinks = this.nav.find('.auth-links');
        this.links = this.nav.find('.mdl-navigation__link');
    }

    setAuthActive(href) {
        this.contentLinks.hide();
        this.authLinks.show();
        this.setCurrentLink(href);
    }

    setContentActive(href) {
        this.authLinks.hide();
        this.contentLinks.show();
        this.setCurrentLink(href);
    }

    setCurrentLink(href) {
        const current = this.nav.find('.mdl-navigation__link--current').first();
        const newCurrent = _.filter(this.links, link => {
            return link.attributes.href.value === `#${href}`;
        });

        if (this.drawer.hasClass('is-visible')) {
            $('.mdl-layout__obfuscator').click();
        }

        if (current) {
            current.removeClass('mdl-navigation__link--current');
        }

        if (newCurrent) {
            $(newCurrent).addClass('mdl-navigation__link--current');
        }
    }
}

export default new NavBarService();
