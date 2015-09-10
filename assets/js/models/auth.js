import _ from 'underscore';
import {Model} from 'backbone';
import Config from '../config';

export default Model.extend({
    defaults: {
        token: null,
        expiresIn: null,
    },

    initialize(options = {}) {
        this.on('sync', this.clearPasswordAttrs);
        this.loadFromStorage();
    },

    clearPasswordAttrs() {
        this.unset('password', {silent: true});
        this.unset('password_confirmation', {silent: true});
    },

    loadFromStorage() {
        let storedData = JSON.parse(localStorage.getItem(Config.storageName));

        if (_.isObject(storedData)) {
            this.set(storedData);
        }
    },

    hasValidSession() {
        return false;
    },
});
