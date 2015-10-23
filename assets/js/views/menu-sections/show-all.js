import {ItemView, CollectionView, TemplateCache} from 'backbone.marionette';

const MenuSectionView = ItemView.extend({
    template: TemplateCache.get('sectionsWrapperSingle'),
    tagName: 'tr',

    templateHelpers() {
        return {
            itemCount() {
                return this.items.length;
            },
        };
    },
});

export default CollectionView.extend({
    childView: MenuSectionView,
    template: TemplateCache.get('sectionsWrapper'),
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
