import {Route} from 'backbone.routing';
import LoginView from '../views/login';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
    },

    render() {
        this.view = new LoginView();
        this.container.show(this.view);
    }
});
