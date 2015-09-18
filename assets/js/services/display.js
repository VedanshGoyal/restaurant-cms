import Service from 'backbone.service';

const DisplayService = Service.extend({
    requests: {
        render: 'render',
    },

    setup(options = {}) {
        this.container = options.container;
    },

    render(view) {
        this.container.show(view);
    },
});

export default new DisplayService();
