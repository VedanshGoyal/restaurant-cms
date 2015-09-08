import _ from 'underscore';
import {TemplateCache} from 'backbone.marionette';
import app from './app.html';
import login from './login.html';
import create from './create.html';
import forgot from './forgot.html';

let templates = {
    app: app,
    login: login,
    create: create,
    forgot: forgot,
};

TemplateCache.prototype.loadTemplate = function(templateId, options) {
    return templates[templateId];    
};

TemplateCache.prototype.compileTemplate = function(rawTemplate, options) {
    return _.template(rawTemplate);
};
