import Marionette from 'backbone.marionette';

class LoginView extends Marionette.ItemView {
    constructor(options) {
        super();
        this.options = options || {};
        this.template = Marionette.TemplateCache.get('login');
    }
}

export default LoginView;
