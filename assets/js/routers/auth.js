import {Router} from 'backbone.routing';
import HeaderService from '../services/header';
import LoginRoute from '../routes/login';
import NewRoute from '../routes/create';
import ForgotRoute from '../routes/forgot';
import VerifyResetRoute from '../routes/verify-reset';
import VerifyNewRoute from '../routes/verify-new';

export default Router.extend({
    routes: {
        'login': 'login',
        'create': 'create',
        'forgot': 'forgot',
        'verify-reset/:token': 'verifyReset',
        'verify-new/:token': 'verifyNew',
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
        HeaderService.request('setTitle', 'New Account');

        return new NewRoute(this._getRouteOptions());
    },

    forgot() {
        HeaderService.request('setTitle', 'Forgot Password');

        return new ForgotRoute(this._getRouteOptions());
    },

    verifyReset(token) {
        HeaderService.request('setTitle', 'Reset Password');
        this.model.set('verify-token', token);

        return new VerifyResetRoute(this._getRouteOptions());
    },

    verifyNew(token) {
        HeaderService.request('setTitle', 'Verify New Account');
        this.model.set('verify-token', token);

        return new VerifyNewRoute(this._getRouteOptions());
    },

    _getRouteOptions() {
        return {
            container: this.container,
            model: this.model,
        };
    },
});
