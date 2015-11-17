import {ItemView, CompositeView, TemplateCache} from 'backbone.marionette';

const PhotoView = ItemView.extend({
    template: TemplateCache.get('photoShow'),
    tagName: 'div',
    className: 'mdl-card mdl-card__image mdl-shadow--2dp mdl-cell mdl-cell--6-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone',

    onBeforeRender() {
        this.$el.css('background', `url('${this.model.get('path')}') center / cover`);
    },
});

export default CompositeView.extend({
    childView: PhotoView,
    template: TemplateCache.get('photoWrapper'),
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',
    childViewContainer: '.mdl-grid',

    collectionEvents: {
        sync: 'render',
    },

    initialize() {
        this.collection.fetch();
    },
});
