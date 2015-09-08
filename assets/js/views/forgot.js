import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../behaviors/mdl';

export default ItemView.extend({
    template: TemplateCache.get('forgot'),
    tagName: 'div',
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
    },
});
