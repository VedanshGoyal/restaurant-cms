import {Route} from 'backbone.routing';
import LoginView from '../../views/auth/login';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
        this.model = options.model;
    },

    render() {
        this.view = new LoginView({model: this.model});
        this.container.show(this.view);
    },
});
