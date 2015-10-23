import {ItemView, CompositeView, TemplateCache} from 'backbone.marionette';

const MenuSectionView = ItemView.extend({
    template: TemplateCache.get('sectionShowTable'),
    tagName: 'tr',

    templateHelpers() {
        return {
            itemCount() {
                return this.items.length;
            },
        };
    },
});

export default CompositeView.extend({
    childView: MenuSectionView,
    template: TemplateCache.get('sectionTable'),
    className: 'mdl-data-table mdl-js-data-table mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'table',

    ui: {
        wrapper: 'tbody',
    },

    collectionEvents: {
        sync: 'render',
    },

    initialize() {
        this.collection.fetch();
    },

    attachBuffer(view, buffer) {
        view.ui.wrapper.html(buffer);
    },
});
