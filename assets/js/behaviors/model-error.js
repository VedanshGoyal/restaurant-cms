import _ from 'underscore';
import {Behavior} from 'backbone.marionette';
import NotifyService from '../services/notify';
import LoadingService from '../services/loading';

export default Behavior.extend({
    modelEvents: {
        'error': 'handleError',
    },

    handleError(model, xhr) {
        LoadingService.request('hide');
        let status = xhr.status;
        let errors = JSON.parse(xhr.responseText);

        if (status === 422) {
            this._markInputs(_.keys(errors));
        }

        if (_.isObject(errors)) {
            NotifyService.request('error', errors);
        }
    },

    _markInputs(fields) {
        _.each(fields, field => {
            let $el = this.view.$(`input[name=${field}]`).parent('div');
            $el.addClass('is-invalid');
        });
    },
});
