import {Collection, sync} from 'backbone';
import AuthService from '../services/auth';
import Config from '../config';

export default Collection.extend({
    sync(method, collection, options = []) {
        options.headers = AuthService.headers();
        return sync(method, collection, options);
    },

    url() {
        return `${Config.apiRoot}/${this.resourceName}`;
    },
});
