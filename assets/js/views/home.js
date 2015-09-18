import {ItemView, TemplateCache} from 'backbone.marionette';

export default ItemView.extend({
    template: TemplateCache.get('home'),
    tagName: 'div',
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
});
