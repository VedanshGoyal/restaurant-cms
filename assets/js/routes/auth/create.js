import {Route} from 'backbone.routing';
import CreateView from '../../views/auth/create';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
        this.model = options.model;
    },

    render() {
        this.view = new CreateView({model: this.model});
        this.container.show(this.view);
    },
});
