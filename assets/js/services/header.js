import _ from 'underscore';
import $ from 'jquery';
import {TemplateCache} from 'backbone.marionette';
import Service from 'backbone.service';

const HeaderService = Service.extend({
    template: TemplateCache.get('header'),
    requests: {
        setTitle: 'setTitle',
        clearTitle: 'clearTitle',
    },

    start(options = {}) {
        this.$el = $('.application .header');
    },

    setTitle(title = 'Welcome') {
        let content = this.template({title: title});

        this.$el.html(content);
    },

    clearTitle() {
        this.container.$el.html('');
    },
});

export default new HeaderService();
