import _ from 'underscore';
import {TemplateCache} from 'backbone.marionette';
import app from './app.html';

let templates = {
    app: app,
};

TemplateCache.prototype.loadTemplate = function(templateId, options) {
    return templates[templateId];    
};

TemplateCache.prototype.compileTemplate = function(rawTemplate, options) {
    return _.template(rawTemplate);
};
