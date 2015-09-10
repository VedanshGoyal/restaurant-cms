import _ from 'underscore';
import {TemplateCache} from 'backbone.marionette';
import app from './app.html';
import header from './header.html';
import login from './login.html';
import create from './create.html';
import forgot from './forgot.html';
import reset from './reset.html';

let templates = {
    app: app,
    header: header,
    login: login,
    create: create,
    forgot: forgot,
    reset: reset,
};

TemplateCache.prototype.loadTemplate = function(templateId, options) {
    return templates[templateId];    
};

TemplateCache.prototype.compileTemplate = function(rawTemplate, options) {
    return _.template(rawTemplate);
};
