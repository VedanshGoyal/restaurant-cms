import {Router} from 'backbone.routing';
import NavbarService from '../services/navbar';
import AuthService from '../services/auth';
import ProtectedRoute from '../routes/protected-route';
import HomeView from '../views/home';

export default Router.extend({
    routes: {
        '': 'index',
        'home': 'home',
    },

    index() {
        AuthService.request('isAuthed').then(isAuthed => {
            let nextHash = (isAuthed) ? 'home' : 'login';
            location.hash = nextHash;
        });
    },

    home() {
        NavbarService.request('setContentActive', 'home');

        return new ProtectedRoute(new HomeView());
    },
});
