import Marionette from 'backbone.marionette';
import LoginView from '../views/login';
import CreateView from '../views/create';
import ResetView from '../views/reset';

class Auth extends Marionette.LayoutView {
    tagName() { return 'section'; }
    className() { return 'section--center mdl-grid mdl-grid--no-spacing'; }
    regions() { return {auth: '.auth-wrapper'}; }

    constructor(options) {
        super();
        this.options = options || {};
        this.template = Marionette.TemplateCache.get('auth');
    }

    setup() {
        this.getRegion('auth').show(new LoginView());
        return this;
    }
}

export default Auth;
