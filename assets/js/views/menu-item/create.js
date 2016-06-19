import {ItemView, TemplateCache} from 'backbone.marionette';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('itemCreate'),
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

    initialize(options) {
        this.section = options.section;
        this.listenTo(this.section, 'sync', this.render);
        this.section.fetch();
    },

    onBeforeRender() {
        this.model.set('priceTwo', this.section.get('sizes') > 1 ? '0' : null);
    },

    handleSubmit() {
        this.model.save(this.form).done(() => {
            window.location.hash = `menu-section/${this.model.get('sectionId')}`;
        });
    },
});
