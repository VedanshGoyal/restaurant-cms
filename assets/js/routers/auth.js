import {Router} from 'backbone.routing';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import Route from '../routes/route';
import LoginView from '../views/auth/login';
import CreatView from '../views/auth/create';
import ForgotView from '../views/auth/forgot';
import VerifyNewView from '../views/auth/verify-new';
import VerifyResetView from '../views/auth/verify-reset';

export default Router.extend({
    routes: {
        'login': 'login',
        'create': 'create',
        'forgot': 'forgot',
        'verify-reset/:token': 'verifyReset',
        'verify-new/:token': 'verifyNew',
    },

    initialize(options = {}) {
        this.model = options.model;
    },

    login() {
        NavbarService.request('setAuthActive', 'login');
        HeaderService.request('setTitle', 'Login');

        return new Route(new LoginView({model: this.model}));
    },

    create() {
        NavbarService.request('setAuthActive', 'create');
        HeaderService.request('setTitle', 'New Account');
    
        return new Route(new CreatView({model: this.model}));
    },

    forgot() {
        NavbarService.request('setAuthActive', 'forgot');
        HeaderService.request('setTitle', 'Forgot Password');

        return new Route(new ForgotView({model: this.model}));
    },

    verifyReset(token) {
        NavbarService.request('setAuthActive');
        HeaderService.request('setTitle', 'Reset Password');
        this.model.set('verify-token', token);

        return new Route(new VerifyResetView({model: this.model}));
    },

    verifyNew(token) {
        NavbarService.request('setAuthActive');
        HeaderService.request('setTitle', 'Verify New Account');
        this.model.set('verify-token', token);

        return new Route(new VerifyNewView({model: this.model}));
    },
});
