import _ from 'lodash';
import Marionette from 'backbone.marionette';

// templates
import content from './content.html';
import auth from './auth/auth.html';
import login from './auth/login.html';
import create from './auth/create.html';
import reset from './auth/reset.html';
import modal from './modal.html';
import about from './about.html';
import footer from './footer.html';
import infoBar from './info-bar.html';
import menuItem from './menu-item.html';
import menuSection from './menu-section.html';
import photos from './photos.html';
import info from './info.html';
import hours from './hours.html';

let templates = {
    content: content,
    auth: auth,
    login: login,
    create: create,
    reset: reset,
    modal: modal,
    about: about,
    footer: footer,
    infoBar: infoBar,
    menuItem: menuItem,
    menuSection: menuSection,
    photos: photos,
    info: info,
    hours: hours,
};

Marionette.TemplateCache.prototype.loadTemplate = function (templateId, options) {
    return templates[templateId];    
};

Marionette.TemplateCache.prototype.compileTemplate = function (rawTemplate, options) {
    return _.template(rawTemplate);
};
