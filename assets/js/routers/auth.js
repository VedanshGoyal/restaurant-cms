import {Router} from 'backbone.routing';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import LoginRoute from '../routes/auth/login';
import NewRoute from '../routes/auth/create';
import ForgotRoute from '../routes/auth/forgot';
import VerifyResetRoute from '../routes/auth/verify-reset';
import VerifyNewRoute from '../routes/auth/verify-new';

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
        NavbarService.request('setAuthActive', 'login');
        HeaderService.request('setTitle', 'Login');

        return new LoginRoute(this._getRouteOptions());
    },

    create() {
        NavbarService.request('setAuthActive', 'create');
        HeaderService.request('setTitle', 'New Account');

        return new NewRoute(this._getRouteOptions());
    },

    forgot() {
        NavbarService.request('setAuthActive', 'forgot');
        HeaderService.request('setTitle', 'Forgot Password');

        return new ForgotRoute(this._getRouteOptions());
    },

    verifyReset(token) {
        NavbarService.request('setAuthActive');
        HeaderService.request('setTitle', 'Reset Password');
        this.model.set('verify-token', token);

        return new VerifyResetRoute(this._getRouteOptions());
    },

    verifyNew(token) {
        NavbarService.request('setAuthActive');
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
