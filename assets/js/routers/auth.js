import Router from './router';
import AuthSerivce from '../services/auth';
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
        login: 'login',
        create: 'create',
        forgot: 'forgot',
        'verify-reset/:token': 'verifyReset',
        'verify-new/:token': 'verifyNew',
    },

    initialize() {
        this.model = AuthSerivce.model;
    },

    login() {
        NavbarService.setAuthActive('login');
        HeaderService.setTitle('Login');

        if (AuthSerivce.isAuthed()) {
            window.location.hash = ' ';
            return false;
        }

        return new Route(new LoginView({model: this.model}));
    },

    create() {
        NavbarService.setAuthActive('create');
        HeaderService.setTitle('Create New Account');

        return new Route(new CreatView({model: this.model}));
    },

    forgot() {
        NavbarService.setAuthActive('forgot');
        HeaderService.setTitle('Forgot Password');

        return new Route(new ForgotView({model: this.model}));
    },

    verifyReset(token) {
        NavbarService.setAuthActive();
        HeaderService.setTitle('Reset Password');
        this.model.set('verify-token', token);

        return new Route(new VerifyResetView({model: this.model}));
    },

    verifyNew(token) {
        NavbarService.setAuthActive();
        HeaderService.setTitle('Verify New Account');
        this.model.set('verify-token', token);

        return new Route(new VerifyNewView({model: this.model}));
    },
});
