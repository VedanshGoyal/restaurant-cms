import Marionette from 'backbone.marionette';

class Auth extends Marionette.LayoutView {
    tagName() { return 'section'; }
    className() { return 'section--center mdl-grid mdl-grid--no-spacing'; }

    constructor(options) {
        super();
        this.options = options || {};
        this.app = options.app;
        this.template = Marionette.TemplateCache.get('auth');
    }

    setup() {
        return this;
    }
}

export default Auth;
