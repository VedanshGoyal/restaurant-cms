import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('itemEdit'),
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
        description: 'textarea',
    },

    initialize() {
        this.model.fetch();
    },

    onRender() {
        this.ui.description.html(this.model.get('description'));
    },

    handleSubmit() {
        this.model.save(this.form).done(() => {
            window.location.hash = `menu-section/${this.model.get('sectionId')}`;
        });
    },

    templateHelpers() {
        return {
            toFixed(num) {
                return Number(num).toFixed(2);
            },
        };
    },
});
