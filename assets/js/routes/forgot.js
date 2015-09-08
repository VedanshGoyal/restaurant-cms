import {Route} from 'backbone.routing';
import ForgotView from '../views/forgot';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
        this.model = options.model;
    },

    render() {
        this.view = new ForgotView({model: this.model});
        this.container.show(this.view);
    },
});
