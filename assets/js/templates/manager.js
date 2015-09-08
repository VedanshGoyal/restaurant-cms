import _ from 'underscore';
import {TemplateCache} from 'backbone.marionette';
import app from './app.html';
import login from './login.html';

let templates = {
    app: app,
    login: login,
};

TemplateCache.prototype.loadTemplate = function(templateId, options) {
    return templates[templateId];    
};

TemplateCache.prototype.compileTemplate = function(rawTemplate, options) {
    return _.template(rawTemplate);
};
