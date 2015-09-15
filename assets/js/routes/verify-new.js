import {Route} from 'backbone.routing';
import VerifyNewView from '../views/verify-new';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
        this.model = options.model;
    },

    render() {
        this.view = new VerifyNewView({model: this.model});
        this.container.show(this.view);
    },
});
