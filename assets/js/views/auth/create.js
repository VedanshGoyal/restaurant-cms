import {ItemView, TemplateCache} from 'backbone.marionette';
import Config from '../../config';
import MDLBehavior from '../../behaviors/mdl';
import FormBehavior from '../../behaviors/form';
import ModelErrorBehavior from '../../behaviors/model-error';

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

    ui: {
        password: 'input[name=password]',
        confirmPass: 'input[name=password_confirmation]',
    },

    modelEvents: {
        error: 'clearPasswords',
    },

    handleSubmit() {
        this.model.url = `${Config.apiRoot}/register`;
        this.model.save(this.form).done(() => {
            window.location.hash = 'login';
        });
    },

    clearPasswords() {
        this.ui.password.val('');
        this.ui.confirmPass.val('');
    },
});
