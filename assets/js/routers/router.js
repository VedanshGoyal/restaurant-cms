import {Router} from 'backbone';
import Route from '../routes/route';

export default Router.extend({
    execute(callback, args) {
        const route = callback.call(this, ...args);

        if (route instanceof Route) {
            route.enter();
        }
    },
});
