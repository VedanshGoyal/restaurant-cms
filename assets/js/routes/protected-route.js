import Route from '../routes/route';
import AuthService from '../services/auth';

export default Route.extend({
    redirectHash: 'login',

    enter(rest = []) {
        this.trigger('before:enter before:fetch', this, ...rest);

        return Promise.resolve().then(() => {
            return this.fetch(...rest);
        }).then(() => {
            if (AuthService.isAuthed()) {
                this.render(...rest);
            } else {
                window.location.hash = this.redirectHash;
            }
        });
    },
});
