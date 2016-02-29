import {ItemView, CompositeView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';
import DialogService from '../../services/dialog';
import LoadingService from '../../services/loading';
import NotifyService from '../../services/notify';

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

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
    },

    modelEvents: {
        sync: 'render',
    },

    events: {
        'click .delete': 'deleteDialog',
    },

    initialize() {
        this.model.fetch();
    },

    onBeforeRender() {
        this.collection.add(this.model.get('items'), {silent: true});
    },

    deleteDialog() {
        const title = `Delete Section`;
        const message = `Deleting ${this.model.get('name')} will also remove its ${this.model.get('items').length} items`;

        DialogService.open(title, message)
        .then(() => this.confirmDelete())
        .catch(() => DialogService.close());
    },

    confirmDelete() {
        DialogService.close();
        LoadingService.show();

        this.model.destroy().done(() => {
            LoadingService.hide();
            NotifyService.success('Menu section deleted');
            window.location.hash = 'menu-sections';
        }).fail(() => {
            LoadingService.hide();
            NotifyService.error('Failed to delete menu section');
        });
    },
});

