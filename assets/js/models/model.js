import _ from 'underscore';
import {Model, sync} from 'backbone';
import AuthService from '../services/auth';

export default Model.extend({
    sync(method, model, options = []) {
        options.headers = AuthService.headers();
        return sync(method, model, options);
    },
});
