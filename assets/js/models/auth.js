import _ from 'underscore';
import {Model} from 'backbone';
import Config from '../config';

export default Model.extend({
    defaults: {
        token: null,
        expiresIn: null,
    },

    initialize(options = {}) {
        this.on('sync', this.clearPassword);
        this.loadFromStorage();
    },

    clearPassword() {
        this.unset('password', {silent: true});
    },

    loadFromStorage() {
        let storedData = JSON.parse(localStorage.getItem(Config.storageName));

        if (_.isObject(storedData)) {
            console.log('setting from storage');
            this.set(storedData);
        }
    }
});
