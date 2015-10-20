import {Router} from 'backbone';

export default Router.extend({
    execute(callback, args) {
        const route = callback.call(this, ...args);

        route.enter();
    },
});
