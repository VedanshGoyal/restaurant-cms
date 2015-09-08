import _ from 'underscore';
import $ from 'jquery';
import Service from 'backbone.service';

const HeaderService = Service.extend({
    template: _.template('<span class="mdl-layout-title"><%- title %></span>'),
    requests: {
        setTitle: 'setTitle',
        clearTitle: 'clearTitle',
    },

    setup(options = {}) {
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
