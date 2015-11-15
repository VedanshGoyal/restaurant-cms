import _ from 'underscore';
import toastr from 'toastr';

class NotifyService {
    constructor() {
        toastr.options = Object.assign({}, toastr.options, {
            progressBar: true,
            positionClass: 'toast-bottom-right',
        });
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
        toastr.remove();

        if (_.isObject(messages) || _.isArray(messages)) {
            _.each(messages, message => {
                const singleMessage = _.isArray(message) ? _.first(message) : message;

                toastr[type](singleMessage);
            });
        } else {
            toastr[type](messages);
        }
    }
}

export default new NotifyService();
