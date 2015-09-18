import {Route} from 'backbone.routing';
import DisplayService from '../services/display';

export default Route.extend({
    initialize(view) {
        this.view = view;
    },

    render() {
        DisplayService.request('render', this.view);
    },
});
