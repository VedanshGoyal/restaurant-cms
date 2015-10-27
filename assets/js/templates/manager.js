import _ from 'underscore';
import {TemplateCache} from 'backbone.marionette';
import Config from '../config';
import home from './home.html';
import header from './header.html';
import login from './auth/login.html';
import create from './auth/create.html';
import forgot from './auth/forgot.html';
import verifyReset from './auth/verify-reset.html';
import verifyNew from './auth/verify-new.html';
import infoShow from './info/show.html';
import infoEdit from './info/edit.html';
import aboutShow from './about/show.html';
import aboutEdit from './about/edit.html';
import hourTable from './hour/table.html';
import hourShowTable from './hour/show-table.html';
import hourEdit from './hour/edit.html';
import sectionTable from './menu-section/table.html';
import sectionShowTable from './menu-section/show-table.html';
import sectionShow from './menu-section/show.html';
import sectionEdit from './menu-section/edit.html';
import itemShowTable from './menu-item/show-table.html';

const templates = {
    home,
    header,
    login,
    create,
    forgot,
    verifyReset,
    verifyNew,
    infoShow,
    infoEdit,
    aboutShow,
    aboutEdit,
    hourTable,
    hourShowTable,
    hourEdit,
    sectionTable,
    sectionShowTable,
    sectionShow,
    sectionEdit,
    itemShowTable,
};

TemplateCache.prototype.loadTemplate = function loadTemplateF(templateId) {
    if (Config.env === 'local') {
        TemplateCache.clear();
    }

    return templates[templateId];
};

TemplateCache.prototype.compileTemplate = function compileTemplateF(rawTemplate) {
    return _.template(rawTemplate);
};
