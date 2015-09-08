import Service from 'backbone.service';
import AuthModel from '../models/auth';

const AuthService = Service.extend({
    requests: {
        isAuthed: 'isAuthed',
    },

    setup(options = {}) {
        this.model = new AuthModel();
    },

    isAuthed() {
        return false;
    }
});

export default new AuthService();
