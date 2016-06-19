import $ from 'jquery';
import {TemplateCache} from 'backbone.marionette';

class HeaderService {
    constructor() {
        this.template = TemplateCache.get('header');
        this.$el = $('.header');
    }

    setTitle(title = 'Welcome') {
        const content = this.template({title});

        this.$el.html(content);
    }

    clearTitle() {
        this.container.$el.html('');
    }
}

export default new HeaderService();
