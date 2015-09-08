import {Router} from 'backbone.routing';
import LoginRoute from '../routes/login';
import HeaderService from '../services/header';

export default Router.extend({
    routes: {
        'login': 'login',
        'create': 'create',
        'reset': 'reste',
        'verify-reset/:token': 'verifyReset',
        'verify-create/:token': 'verifyCreate',
    },

    initialize(options = {}) {
        this.container = options.container;
    },

    login() {
        HeaderService.request('setTitle', 'Login');

        return new LoginRoute({
            container: this.container,
        });
    },

    create() {

    },

    reset() {

    },

    verifyReset(token) {

    },

    verifyCreate(token) {

    },
});
