import 'material-design-lite';
import 'babel/polyfill';
import $ from 'jquery';
import _ from 'underscore';
import Backbone from 'backbone';
import Radio from 'backbone.radio';
import {Application} from 'backbone.marionette';

import './templates/manager';
import Config from './config';
import AppLayout from './layouts/app';
import AuthService from './services/auth';
import HeaderService from './services/header';
import NotifyService from './services/notify';
import LoadingService from './services/loading';
import IndexRouter from './routers/index';
import AuthRouter from './routers/auth';
import AuthModel from './models/auth';

const App = Application.extend({
    initialize() {
        this.layout = new AppLayout();
        this.layout.render();
    }
});

const app = new App();
const authModel = new AuthModel();

AuthService.setup({model: authModel});
HeaderService.setup();
NotifyService.setup();
LoadingService.setup();

app.routers = {
    index: new IndexRouter({container: app.layout.content}),
    auth: new AuthRouter({container: app.layout.content, model: authModel}),
};


Backbone.history.start({root: Config.urlRoot});
