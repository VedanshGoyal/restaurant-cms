import Backbone from 'backbone';

class AuthModel extends Backbone.Model {
    constructor(options) {
        super();
        this.options = options || {};
        this.authData = this.loadFromLS();
    }

    isAuthed() {
        let tokenData = this.authData;

        if (!tokenData) { return false; }

        return true;
    }

    loadFromLS() {
        return localStorage.getItem(this.options.storageName);
    }
}

export default AuthModel;
