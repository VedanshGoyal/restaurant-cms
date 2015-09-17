import ProtectedRoute from './protected-route';
import HomeView from '../views/home';

export default ProtectedRoute.extend({
    initialize(options = {}) {
        this.container = options.container;
    },

    render() {
        this.view = new HomeView();
        this.container.show(this.view);
    },
});
