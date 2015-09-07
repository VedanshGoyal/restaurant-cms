import _ from 'underscore';
import Marionette from 'backbone.marionette';

let templates = {};

Marionette.TemplateCache.prototype.loadTemplate = function (templateId, options) {
    return templates[templateId];    
};

Marionette.TemplateCache.prototype.compileTemplate = function (rawTemplate, options) {
    return _.template(rawTemplate);
};
