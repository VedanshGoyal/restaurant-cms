import Router from './router';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import ProtectedRoute from '../routes/protected-route';
import PhotosCollection from '../collections/photos';
import ShowAllView from '../views/photo/show-all';

export default Router.extend({
    routes: {
        photos: 'showAll',
    },

    showAll() {
        NavbarService.setContentActive('photos');
        HeaderService.setTitle('Photos');
        const collection = new PhotosCollection();

        return new ProtectedRoute(new ShowAllView({collection}));
    },
});
