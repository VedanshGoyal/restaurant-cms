import {Route} from 'backbone.routing';
import ResetView from '../views/reset';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
        this.model = options.model;
    },

    render() {
        this.view = new ResetView({model: this.model});
        this.container.show(this.view);
    },
});
