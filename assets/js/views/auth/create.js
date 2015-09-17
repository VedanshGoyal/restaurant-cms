import {ItemView, TemplateCache} from 'backbone.marionette';
import Config from '../config';
import MDLBehavior from '../behaviors/mdl';
import FormBehavior from '../behaviors/form';
import ModelErrorBehavior from '../behaviors/model-error';
import LoadingService from '../services/loading';
import NotifyService from '../services/notify';

export default ItemView.extend({
    template: TemplateCache.get('create'),
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

        this.model.url = Config.apiRoot + '/register';
        this.model.set(this.form);

        this.model.save().done(response => {
            LoadingService.request('hide');
            NotifyService.request('info', 'Account created. Please check email for further instructions.');

            window.location.hash = 'login';
        });
    },
});
