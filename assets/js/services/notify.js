import _ from 'underscore';
import Tango from 'backbone.tango';

class NotifyService {
    constructor() {
        this.tango = new Tango();
    }

    error(messages) {
        this._notify('error', messages);
    }

    success(messages) {
        this._notify('success', messages);
    }

    info(messages) {
        this._notify('info', messages);
    }

    warning(messags) {
        this._notify('warning', messages);
    }

    _notify(type = 'error', messages) {
        if (_.isObject(messages) || _.isArray(messages)) {
            _.each(messages, message => {
                message = _.isArray(message) ? _.first(message) : message;
                this.tango[type](message);
            });
        } else {
            this.tango[type](messages);
        }
    }
}

export default new NotifyService();
