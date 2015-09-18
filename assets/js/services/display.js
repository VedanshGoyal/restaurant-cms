import {Region} from 'backbone.marionette';

class DisplayService {
    constructor() {
        this.container = new (Region.extend({el: '.content'}))();
    }

    render(view) {
        console.log('rendering view');
        this.container.show(view);
    }
}

export default new DisplayService();
