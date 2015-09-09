import $ from 'jquery';
import Service from 'backbone.service';

const LoadingService = Service.extend({
    requests: {
        show: 'show',
        hide: 'hide',
    },

    setup(options = {}) {
        this.$el = $('.loading-overlay');
    },

    show() {
        this.$el.show(); 
    },

    hide() {
        this.$el.hide();
    },
});

export default new LoadingService();
