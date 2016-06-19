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
    childViewContainer: 'tbody',
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',

    collectionEvents: {
        sync: 'render',
    },

    initialize() {
        this.collection.fetch();
    },
});
