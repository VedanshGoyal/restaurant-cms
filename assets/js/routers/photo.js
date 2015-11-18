import Router from './router';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import ProtectedRoute from '../routes/protected-route';
import PhotoModel from '../models/photo';
import PhotosCollection from '../collections/photos';
import ShowAllView from '../views/photo/show-all';
import CreateView from '../views/photo/create';

export default Router.extend({
    routes: {
        photos: 'showAll',
        'photo/add': 'add',
    },

    showAll() {
        NavbarService.setContentActive('photos');
        HeaderService.setTitle('Photos');
        const collection = new PhotosCollection();

        return new ProtectedRoute(new ShowAllView({collection}));
    },

    add() {
        NavbarService.setContentActive('photos');
        HeaderService.setTitle('Add Photo');
        const model = new PhotoModel();

        return new ProtectedRoute(new CreateView({model}));
    },
});
