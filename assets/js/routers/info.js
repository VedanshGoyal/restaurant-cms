import {Router} from 'backbone.routing';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import InfoModel from '../models/info';
import ProtectedRoute from '../routes/protected-route';
import ShowView from '../views/info/show';
import EditView from '../views/info/edit';

export default Router.extend({
    routes: {
        info: 'show',
        'info/edit': 'edit',
    },

    initialize() {
        this.model = new InfoModel({id: 1});
    },

    show() {
        NavbarService.setContentActive('info');
        HeaderService.setTitle('Info');

        return new ProtectedRoute(new ShowView({model: this.model}));
    },

    edit() {
        NavbarService.setContentActive('info');
        HeaderService.setTitle('Edit Info');

        return new ProtectedRoute(new EditView({model: this.model}));
    },
});
