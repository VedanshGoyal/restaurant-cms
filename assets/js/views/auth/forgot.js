import {ItemView, TemplateCache} from 'backbone.marionette';
import Config from '../../config';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';
import NotifyService from '../../services/notify';
import LoadingService from '../../services/loading';

export default ItemView.extend({
    template: TemplateCache.get('forgot'),
    tagName: 'div',
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',

    events: {
        'submit form': 'handleSubmit',
    },

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
        form: {behaviorClass: FormBehavior},
        modelError: {behaviorClass: ModelErrorBehavior},
    },

    handleSubmit() {
        LoadingService.show();

        this.model.url = Config.apiRoot + '/reset-password';
        this.model.set(this.form).save().done(response => {
            LoadingService.hide();
            NotifyService.success('Please check your email for a password reset link.');

            window.location.hash = 'login';
        });
    },
});
