import _ from 'lodash';
import Marionette from 'backbone.marionette';

// templates
import dash from './dash.html';
import auth from './auth.html';
import modal from './modal.html';
import about from './about.html';
import footer from './footer.html';
import infoBar from './info-bar.html';
import menuItem from './menu-item.html';
import menuSection from './menu-section.html';
import photos from './photos.html';
import info from './info.html';
import hours from './hours.html';

let templates = {};
templates.dash = dash;
templates.auth = auth;
templates.modal = modal;
templates.about = about;
templates.footer = footer;
templates.infoBar = infoBar;
templates.menuItem = menuItem;
templates.menuSection = menuSection;
templates.photos = photos;
templates.info = info;
templates.hours = hours;

Marionette.TemplateCache.prototype.loadTemplate = function (templateId, options) {
    return templates[templateId];    
};

Marionette.TemplateCache.prototype.compileTemplate = function (rawTemplate, options) {
    return _.template(rawTemplate);
};
