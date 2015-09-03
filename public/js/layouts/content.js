import Marionette from 'backbone.marionette';

class Content extends Marionette.LayoutView {
    className() { return 'content-wrapper'; }

    constructor(options) {
        super();
        this.options = options || {};
        this.template = Marionette.TemplateCache.get('content');
    }

    setup() {
        return this;
    }
}

export default Content;
