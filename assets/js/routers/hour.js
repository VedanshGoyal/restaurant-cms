import Router from './router';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import ProtectedRoute from '../routes/protected-route';
import HoursCollection from '../collections/hours';
import HourModel from '../models/hour';
import ShowView from '../views/hours/show';
import EditView from '../views/hours/edit';

export default Router.extend({
    routes: {
        hours: 'show',
        'hour/:id/edit': 'edit',
    },

    initialize() {
        this.collection = new HoursCollection();
    },

    show() {
        NavbarService.setContentActive('hours');
        HeaderService.setTitle('Hours');

        return new ProtectedRoute(new ShowView({collection: this.collection}));
    },

    edit(id) {
        NavbarService.setContentActive('hours');
        HeaderService.setTitle('Edit Hours');
        const model = this.collection.get(id) || new HourModel({id});

        return new ProtectedRoute(new EditView({model}));
    },
});

