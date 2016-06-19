import Router from './router';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import ProtectedRoute from '../routes/protected-route';
import AboutModel from '../models/about';
import ShowView from '../views/about/show';
import EditView from '../views/about/edit';

export default Router.extend({
    routes: {
        about: 'show',
        'about/edit': 'edit',
    },

    initialize() {
        this.model = new AboutModel({id: 1});
    },

    show() {
        NavbarService.setContentActive('about');
        HeaderService.setTitle('About');

        return new ProtectedRoute(new ShowView({model: this.model}));
    },

    edit() {
        NavbarService.setContentActive('about');
        HeaderService.setTitle('Edit About');

        return new ProtectedRoute(new EditView({model: this.model}));
    },
});
