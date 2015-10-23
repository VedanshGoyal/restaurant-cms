import {ItemView, CompositeView, TemplateCache} from 'backbone.marionette';

const HourView = ItemView.extend({
    template: TemplateCache.get('hourShowTable'),
    tagName: 'tr',

    templateHelpers() {
        return {
            closedStatus() {
                return this.isClosed ? 'Yes' : 'No';
            },
        };
    },
});

export default CompositeView.extend({
    childView: HourView,
    template: TemplateCache.get('hourTable'),
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
