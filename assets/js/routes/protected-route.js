import Route from '../routes/route';
import AuthService from '../services/auth';

export default Route.extend({
    redirectHash: 'login',

    enter(rest = []) {
        this._isEntering = true;
        this.trigger('before:enter before:fetch', this, ...rest);

        return Promise.resolve().then(() => {
            return this.fetch(...rest);
        }).then(() => {
            this.trigger('fetch before:render', this, ...rest);   
        }).then(() => {
            if (AuthService.isAuthed()) {
                this.render(...rest);
            } else {
                window.location.hash = this.redirectHash;
            }
        }).then(() => {
            this._isEntering = false;   
            this.trigger('render enter', this, ...rest);
        }).catch(error => {
            this._isEntering = false;
            this.trigger('error error:enter', this, ...rest);

            throw error;
        });
    },
});
