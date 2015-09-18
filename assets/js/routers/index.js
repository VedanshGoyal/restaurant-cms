import {Router} from 'backbone.routing';
import NavbarService from '../services/navbar';
import ProtectedRoute from '../routes/protected-route';
import HomeView from '../views/home';

export default Router.extend({
    routes: {
        '': 'index',
    },

    index() {
        NavbarService.setContentActive('home');

        return new ProtectedRoute(new HomeView());
    },
});
