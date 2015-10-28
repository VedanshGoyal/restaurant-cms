import {Model, sync} from 'backbone';
import Config from '../config';
import AuthService from '../services/auth';

export default Model.extend({
    sync(method, model, options = []) {
        options.headers = AuthService.headers();
        return sync(method, model, options);
    },

    url() {
        return this.isNew()
            ? `${Config.apiRoot}/${this.resourceName}`
            : `${Config.apiRoot}/${this.resourceName}/${this.get('id')}`;
    },
});
