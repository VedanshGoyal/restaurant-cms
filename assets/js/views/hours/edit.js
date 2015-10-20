import {ItemView, TemplateCache} from 'backbone.marionette';
import LoadingService from '../../services/loading';
import NotifyService from '../../services/notify';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('hourEdit'),
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',

    events: {
        'submit form': 'handleSubmit',
        'focus input[type=text]': 'inputFocused',
    },

    modelEvents: {
        sync: 'render',
    },

    initialize(options) {
        this.timepicker = options.timepicker;
        this.model.fetch();
    },

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
        form: {behaviorClass: FormBehavior},
        modelError: {behaviorClass: ModelErrorBehavior},
    },

    handleSubmit() {
        LoadingService.show();

        this.model.set(this.form).save().done(() => {
            LoadingService.hide();
            NotifyService.success(`${this.model.get('day')} updated successfully`);

            window.location.hash = 'hours';
        });
    },

    inputFocused(event) {
        this.timepicker.openOnInput(event.target);
    },
});
