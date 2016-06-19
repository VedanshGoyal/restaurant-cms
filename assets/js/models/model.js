import {Model, sync} from 'backbone';
import {isUndefined} from 'underscore';
import LoadingService from '../services/loading';
import AuthService from '../services/auth';
import Config from '../config';

export default Model.extend({
    sync(method, model, options = []) {
        if (method.toLowerCase() !== 'read') {
            LoadingService.show();
        }

        options.headers = AuthService.headers();
        return sync(method, model, options);
    },

    url() {
        return this.isNew()
            ? `${Config.apiRoot}/${this.resourceName}`
            : `${Config.apiRoot}/${this.resourceName}/${this.get('id')}`;
    },

    parse(response) {
        LoadingService.hide();

        return isUndefined(response.data) ? response : response.data;
    },
});
