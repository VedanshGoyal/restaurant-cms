import Service from 'backbone.service';

const AuthService = Service.extend({
    requests: {
        isAuthed: 'isAuthed',
    },

    setup(options = {}) {
        this.model = options.model;
    },

    isAuthed() {
        return false;
    }
});

export default new AuthService();
