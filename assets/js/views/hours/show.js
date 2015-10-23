import {ItemView, CollectionView, TemplateCache} from 'backbone.marionette';

const HourView = ItemView.extend({
    template: TemplateCache.get('hourSingle'),
    tagName: 'tr',

    templateHelpers() {
        return {
            closedStatus() {
                return this.isClosed ? 'Yes' : 'No';
            },
        };
    },
});

export default CollectionView.extend({
    childView: HourView,
    template: TemplateCache.get('hourWrapper'),
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
