import {Router} from 'backbone.routing';
import AuthService from '../services/auth';

export default Router.extend({
    routes: {
        '': 'index',
    },

    index() {
        AuthService.request('isAuthed').then(isAuthed => {
            let nextHash = (isAuthed) ? 'content' : 'login';
            location.hash = nextHash;
        });
    },
});
