import $ from 'jquery';
import _ from 'underscore';

class NavBarService {
    constructor() {
        this.contentLinks = $('.navigation').find('.content-links');
        this.authLinks = $('.navigation').find('.auth-links');
        this.links = $('.navigation').find('.mdl-navigation__link');
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
        const current = $('.mdl-navigation__link--current');
        const newCurrent = _.filter(this.links, link => {
            return link.attributes.href.value === `#${href}`;
        });

        if (current) {
            current.removeClass('mdl-navigation__link--current');
        }
        if (newCurrent) {
            $(newCurrent).addClass('mdl-navigation__link--current');
        }
    }
}

export default new NavBarService();
