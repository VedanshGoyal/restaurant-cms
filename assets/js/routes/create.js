import {Route} from 'backbone.routing';
import CreateView from '../views/create';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
    },

    render() {
        this.view = new CreateView();
        this.container.show(this.view);
    },
});
