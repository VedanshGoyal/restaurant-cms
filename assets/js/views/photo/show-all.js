import {ItemView, CompositeView, TemplateCache} from 'backbone.marionette';
import DialogService from '../../services/dialog';
import LoadingService from '../../services/loading';
import NotifyService from '../../services/notify';

const PhotoView = ItemView.extend({
    template: TemplateCache.get('photoShow'),
    tagName: 'div',
    className: 'mdl-card mdl-card__image mdl-shadow--2dp mdl-cell mdl-cell--6-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone',

    events: {
        'click .remove-btn': 'deleteDialog',
    },

    onBeforeRender() {
        this.$el.css('background', `url('${this.model.get('path')}') center / cover`);
    },

    deleteDialog() {
        const title = 'Delete Image';
        const message = 'Are you sure you want to delete this image?';

        DialogService.open(title, message)
        .then(() => this.confirmDelete())
        .catch(() => DialogService.close());
    },

    confirmDelete() {
        DialogService.close();
        LoadingService.show();

        this.model.destroy().done(() => {
            LoadingService.hide();
            NotifyService.success('Image deleted successfully');
            this.destroy();
        }).fail(() => {
            LoadingService.hide();
            NotifyService.success('Failed to delete image');
        });
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
