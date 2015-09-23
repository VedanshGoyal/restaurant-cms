import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';

export default ItemView.extend({
    template: TemplateCache.get('infoShow'),
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
    },

    modelEvents: {
        sync: 'render',
    },

    initialize() {
        this.model.fetch();
    },
});
