import {ItemView, TemplateCache} from 'backbone.marionette';
import Config from '../../config';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';
import NotifyService from '../../services/notify';
import LoadingService from '../../services/loading';

export default ItemView.extend({
    template: TemplateCache.get('verifyNew'),
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
        LoadingService.request('show');

        this.model.url = Config.apiRoot + '/verify-new';
        this.model.set(this.form).save().done(response => {
            LoadingService.request('hide');
            NotifyService.request('success', 'Account successfully activated.');

            this.model.set('token', response.token);
            this.model.set('expiresIn', response.expiresIn);
            this.model.saveToStorage();
            window.location.hash = ' ';
        });
    },
});
