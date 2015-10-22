import Router from './router';
import HeaderService from '../services/header';
import NavbarService from '../services/navbar';
import AuthService from '../services/auth';
import ProtectedRoute from '../routes/protected-route';
import HomeView from '../views/home';

export default Router.extend({
    routes: {
        '': 'index',
        logout: 'logout',
    },

    index() {
        HeaderService.setTitle('Home');
        NavbarService.setContentActive('home');

        return new ProtectedRoute(new HomeView());
    },

    logout() {
        AuthService.logout();
    },
});
