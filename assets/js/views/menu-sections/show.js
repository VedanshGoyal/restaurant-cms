import {ItemView, CompositeView, TemplateCache} from 'backbone.marionette';

const MenuItemView = ItemView.extend({
    template: TemplateCache.get('itemShowTable'),
    tagName: 'tr',
});

export default CompositeView.extend({
    template: TemplateCache.get('sectionShow'),
    childView: MenuItemView,
    childViewContainer: 'tbody',
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',

    modelEvents: {
        sync: 'render',
    },

    initialize() {
        this.model.fetch();
    },

    onBeforeRender() {
        this.collection.add(this.model.get('items'), {silent: true});
    },
});

