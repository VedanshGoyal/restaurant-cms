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
import hourWrapper from './hour/hourWrapper.html';
import hourSingle from './hour/hourSingle.html';

const templates = {
    home: home,
    header: header,
    login: login,
    create: create,
    forgot: forgot,
    verifyReset: verifyReset,
    verifyNew: verifyNew,
    infoShow: infoShow,
    infoEdit: infoEdit,
    aboutShow: aboutShow,
    aboutEdit: aboutEdit,
    hourWrapper: hourWrapper,
    hourSingle: hourSingle,
};

TemplateCache.prototype.loadTemplate = function(templateId, options) {
    if (Config.env === 'local') { TemplateCache.clear(); }

    return templates[templateId];    
};

TemplateCache.prototype.compileTemplate = function(rawTemplate, options) {
    return _.template(rawTemplate);
};
