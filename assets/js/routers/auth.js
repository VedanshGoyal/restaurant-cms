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
        this.model = options.model;
    },

    login() {
        HeaderService.request('setTitle', 'Login');

        return new LoginRoute(this._getRouteOptions());
    },

    create() {
        HeaderService.request('setTitle', 'Create Account');

        return new CreateRoute(this._getRouteOptions());
    },

    forgot() {
        HeaderService.request('setTitle', 'Forgot Password');

        return new ForgotRoute(this._getRouteOptions());
    },

    verifyReset(token) {

    },

    verifyCreate(token) {

    },

    _getRouteOptions() {
        return {
            container: this.container,
            model: this.model,
        };
    },
});
