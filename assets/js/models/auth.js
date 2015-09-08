import {Model} from 'backbone';
import Config from '../config';

export default Model.extend({
    initialize(options = {}) {
        this._loadFromStorage();
    },

    _loadFromStorage() {
        let tokenData = localStorage.getItem(Config.authStorageKey);
    }
});
