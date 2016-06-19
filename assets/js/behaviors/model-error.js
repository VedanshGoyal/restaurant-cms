import {each, isUndefined, isEmpty, keys} from 'underscore';
import {Behavior} from 'backbone.marionette';
import NotifyService from '../services/notify';
import LoadingService from '../services/loading';

export default Behavior.extend({
    modelEvents: {
        error: 'handleError',
        sync: 'handleSuccess',
    },

    collectionEvents: {
        sync: 'handleSuccess',
    },

    handleError(model, xhr) {
        LoadingService.hide();
        const status = xhr.status;
        const response = JSON.parse(xhr.responseText);
        const message = response.meta.message || {};
        const errors = response.meta.errors || {};

        if (!isEmpty(errors)) {
            NotifyService.error(errors);

            if (status === 422) {
                this.markInputs(keys(errors));
            }
        } else if (message.length) {
            NotifyService.warning(message);
        } else {
            NotifyService.error('Something went wrong...');
        }
    },

    handleSuccess(data, response) {
        if (!isUndefined(response.meta) && !isUndefined(response.meta.message)) {
            NotifyService.success(response.meta.message);
        }
    },

    markInputs(fields) {
        each(fields, field => {
            const inputEl = this.view.$(`input[name=${field}]`).parent('div');

            if (!isUndefined(inputEl) && inputEl.length) {
                inputEl.addClass('is-invalid');
            }
        });
    },
});
