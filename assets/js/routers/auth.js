import {Router} from 'backbone.routing';
import LoginRoute from '../routes/login';
import CreateRoute from '../routes/create';
import ForgotRoute from '../routes/forgot';
import HeaderService from '../services/header';

export default Router.extend({
    routes: {
        'login': 'login',
        'create': 'create',
        'forgot': 'forgot',
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
        HeaderService.request('setTitle', 'Create Account');

        return new CreateRoute({
            container: this.container,
        });
    },

    forgot() {
        HeaderService.request('setTitle', 'Forgot Password');

        return new ForgotRoute({
            container: this.container,
        });
    },

    verifyReset(token) {

    },

    verifyCreate(token) {

    },
});
