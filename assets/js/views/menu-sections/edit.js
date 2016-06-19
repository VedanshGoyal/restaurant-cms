import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('sectionEdit'),
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

    ui: {
        info: 'textarea',
    },

    initialize() {
        this.model.fetch();
    },

    onRender() {
        this.ui.info.html(this.model.get('info'));
    },

    handleSubmit() {
        this.model.save(this.form).done(() => {
            window.location.hash = `menu-section/${this.model.get('id')}`;
        });
    },
});
