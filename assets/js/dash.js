import 'material-design-lite';
import 'babel/polyfill';
import './templates/manager';
import Backbone from 'backbone';
import Config from './config';
import IndexRouter from './routers/index';
import AuthRouter from './routers/auth';
import InfoRouter from './routers/info';

const App = {};

App.routers = {
    index: new IndexRouter(),
    auth: new AuthRouter(),
    info: new InfoRouter(),
};

Backbone.history.start({root: Config.urlRoot});
