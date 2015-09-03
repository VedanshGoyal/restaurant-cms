import Marionette from 'backbone.marionette';

class CreateView extends Marionette.ItemView {
    constructor(options) {
        super();
        this.options = options || {};
        this.template = Marionette.TemplateCache.get('create');
    }
}

export default CreateView;
