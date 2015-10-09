import _ from 'underscore';
import {Behavior} from 'backbone.marionette';
import NotifyService from '../services/notify';
import LoadingService from '../services/loading';

export default Behavior.extend({
    modelEvents: {
        error: 'handleError',
    },

    handleError(model, xhr) {
        LoadingService.hide();
        const status = xhr.status;
        const errors = JSON.parse(xhr.responseText);

        if (status === 422) {
            this.markInputs(_.keys(errors));
        }

        if (_.isObject(errors)) {
            NotifyService.error(errors);
        }
    },

    markInputs(fields) {
        _.each(fields, field => {
            const $el = this.view.$(`input[name=${field}]`).parent('div');

            $el.addClass('is-invalid');
        });
    },
});
