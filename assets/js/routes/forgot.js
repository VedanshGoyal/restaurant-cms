import {Route} from 'backbone.routing';
import ForgotView from '../views/forgot';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
    },

    render() {
        this.view = new ForgotView();
        this.container.show(this.view);
    },
});
