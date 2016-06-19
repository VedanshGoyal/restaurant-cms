import {Collection, sync} from 'backbone';
import {isUndefined} from 'underscore';
import LoadingService from '../services/loading';
import AuthService from '../services/auth';
import Config from '../config';

export default Collection.extend({
    sync(method, collection, options = []) {
        if (method.toLowerCase() !== 'get') {
            LoadingService.show();
        }

        options.headers = AuthService.headers();
        return sync(method, collection, options);
    },

    url() {
        return `${Config.apiRoot}/${this.resourceName}`;
    },

    parse(response) {
        return isUndefined(response.data) ? response : response.data;
    },
});
