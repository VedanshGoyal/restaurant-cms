import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('infoEdit'),
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',

    events: {
        'submit form': 'handleSubmit',
    },

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
        form: {behaviorClass: FormBehavior},
        modelError: {behaviorClass: ModelErrorBehavior},
    },

    modelEvents: {
        sync: 'render',
    },

    initialize() {
        this.model.fetch();
    },

    handleSubmit() {
        this.model.save(this.form).done(() => {
            window.location.hash = 'info';
        });
    },
});
