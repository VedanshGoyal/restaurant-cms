import 'material-design-lite';
import $ from 'jquery';
import _ from 'underscore';
import Backbone from 'backbone';
import Marionette from 'backbone.marionette';
import AuthLayout from './layouts/auth';
import ContentLayout from './layouts/content';
import AuthModel from './models/auth';
import './templates/manager';

class App extends Marionette.Application {
    constructor(options) {
        super();
        this.options = options;
        this.$appEl = $('#app');
        this.authData = {};

        this.auth = new AuthModel({app: this});
        this.authLayout = new AuthLayout({app: this});
        this.contentLayout = new ContentLayout({app: this});

        this.initApp();
    }

    initApp() {
        let layout = (this.auth.isAuthed()) ? this.contentLayout : this.authLayout;

        this.$appEl.html(layout.render().setup().el);
    }
}

let options = {storageName: 'authToken'};
let app = new App(options);
