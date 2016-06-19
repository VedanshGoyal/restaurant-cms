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
import sectionCreate from './menu-section/create.html';
import itemShowTable from './menu-item/show-table.html';
import itemEdit from './menu-item/edit.html';
import itemCreate from './menu-item/create.html';
import photoWrapper from './photo/wrapper.html';
import photoShow from './photo/show.html';
import photoCreate from './photo/create.html';

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
    sectionCreate,
    itemShowTable,
    itemEdit,
    itemCreate,
    photoWrapper,
    photoShow,
    photoCreate,
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
