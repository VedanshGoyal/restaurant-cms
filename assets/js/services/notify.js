import _ from 'underscore';
import Service from 'backbone.service';
import Tango from 'backbone.tango';

const Notify = Service.extend({
    requests: {
        error: 'error',
        success: 'success',
        info: 'info',
        warning: 'warning',
    },

    setup(options = {}) {
        this.tango = new Tango();
    },

    error(messages = {}) {
        this._notify('error', messages);
    },

    notfiySuccess(messages = {}) {
        this._notify('success', messages);
    },

    notifyInfo(messages = {}) {
        this._notify('info', messages);
    },

    notifyWarning(messags = {}) {
        this._notify('warning', messages);
    },

    _notify(type = 'error', messages = {}) {
        _.each(messages, message => {
            this.tango[type](_.first(message));
        });
    },
});

export default new Notify();
