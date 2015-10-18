import _ from 'underscore';
import Tango from 'backbone.tango';

class NotifyService {
    constructor() {
        this.tango = new Tango.Notifier();
    }

    error(messages) {
        this.notify('error', messages);
    }

    success(messages) {
        this.notify('success', messages);
    }

    info(messages) {
        this.notify('info', messages);
    }

    warning(messages) {
        this.notify('warning', messages);
    }

    notify(type = 'error', messages) {
        if (_.isObject(messages) || _.isArray(messages)) {
            _.each(messages, message => {
                const singleMessage = _.isArray(message) ? _.first(message) : message;

                this.tango[type](singleMessage);
            });
        } else {
            this.tango[type](messages);
        }
    }
}

export default new NotifyService();
