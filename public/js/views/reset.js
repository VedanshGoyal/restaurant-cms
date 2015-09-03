import Marionette from 'backbone.marionette';

class ResetView extends Marionette.ItemView {
    constructor(options) {
        super();
        this.options = options || {};
        this.template = Marionette.TemplateCache.get('reset');
    }
}

export default ResetView;
