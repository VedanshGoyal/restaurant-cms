import {Region} from 'backbone.marionette';

class DisplayService {
    constructor() {
        this.container = new (Region.extend({el: '.content'}))();
    }

    render(view) {
        this.container.show(view);
    }
}

export default new DisplayService();
