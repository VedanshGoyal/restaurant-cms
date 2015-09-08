import 'material-design-lite';
import 'babel/polyfill';
import $ from 'jquery';
import _ from 'underscore';
import Backbone from 'backbone';
import Radio from 'backbone.radio';
import {Application} from 'backbone.marionette';

import './templates/manager';
import AppLayout from './layouts/app';
import AuthService from './services/auth';
import HeaderService from './services/header';

import IndexRouter from './routers/index';
import AuthRouter from './routers/auth';

const App = Application.extend({
    initialize() {
        this.layout = new AppLayout();
        this.layout.render();
    }
});

const app = new App();

AuthService.setup();
HeaderService.setup();

app.routers = {
    index: new IndexRouter(),
    auth: new AuthRouter({container: app.layout.content}),
};


Backbone.history.start({root: '/dash/'});
