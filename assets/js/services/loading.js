import $ from 'jquery';

class LoadingService {
    constructor() {
        this.$el = $('.loading-overlay');
    }

    show() {
        this.$el.show();
    }

    hide() {
        this.$el.hide();
    }
}

export default new LoadingService();
