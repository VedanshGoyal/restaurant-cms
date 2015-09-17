import {Route} from 'backbone.routing';
import VerifyResetView from '../../views/auth/verify-reset';

export default Route.extend({
    initialize(options = {}) {
        this.container = options.container;
        this.model = options.model;
    },

    render() {
        this.view = new VerifyResetView({model: this.model});
        this.container.show(this.view);
    },
});
