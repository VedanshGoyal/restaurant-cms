import _ from 'underscore';
import {Model} from 'backbone';
import Config from '../config';

export default Model.extend({
    defaults: {
        token: null,
        expiresIn: null,
    },

    initialize() {
        this.on('sync', this.clearTempAttrs);
        this.loadFromStorage();
    },

    clearTempAttrs() {
        this.unset('password', {silent: true});
        this.unset('password_confirmation', {silent: true});
        this.unset('verify-token', {sliten: true});
    },

    loadFromStorage() {
        const storedData = JSON.parse(localStorage.getItem(Config.storageName));

        if (_.isObject(storedData)) {
            this.set(storedData);
        }
    },

    saveToStorage() {
        const attrs = this.attributes;

        localStorage.setItem(Config.storageName, JSON.stringify(attrs));
    },

    clearStorage() {
        localStorage.removeItem(Config.storagename);
    },

    hasValidSession() {
        const expiresIn = this.get('expiresIn');
        const currentTime = new Date().getTime() / 1000;

        if (this.has('token') && currentTime < expiresIn) {
            return true;
        }

        this.clearStorage();
        return false;
    },
});
