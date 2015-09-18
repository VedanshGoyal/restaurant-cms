import _ from 'underscore';
import {TemplateCache} from 'backbone.marionette';
import home from './home.html';
import header from './header.html';
import login from './auth/login.html';
import create from './auth/create.html';
import forgot from './auth/forgot.html';
import verifyReset from './auth/verify-reset.html';
import verifyNew from './auth/verify-new.html';

let templates = {
    home: home,
    header: header,
    login: login,
    create: create,
    forgot: forgot,
    verifyReset: verifyReset,
    verifyNew: verifyNew,
};

TemplateCache.prototype.loadTemplate = function(templateId, options) {
    return templates[templateId];    
};

TemplateCache.prototype.compileTemplate = function(rawTemplate, options) {
    return _.template(rawTemplate);
};
