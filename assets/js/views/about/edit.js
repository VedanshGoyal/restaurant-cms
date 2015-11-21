import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('aboutEdit'),
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
        content: 'textarea',
    },

    initialize() {
        this.model.fetch();
    },

    onRender() {
        this.ui.content.html(this.model.get('content'));
    },

    handleSubmit() {
        this.model.save(this.form).done(() => {
            window.location.hash = 'about';
        });
    },
});
