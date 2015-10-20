import 'mdl';
import 'babel/polyfill';
import './templates/manager';
import Backbone from 'backbone';
import TimePicker from 'material-timepicker';
import Config from './config';
import IndexRouter from './routers/index';
import AuthRouter from './routers/auth';
import InfoRouter from './routers/info';
import AboutRouter from './routers/about';
import HourRouter from './routers/hour';

const App = {};

App.routers = {
    index: new IndexRouter(),
    auth: new AuthRouter(),
    info: new InfoRouter(),
    about: new AboutRouter(),
    hours: new HourRouter(new TimePicker()),
};

Backbone.history.start({root: Config.urlRoot});
