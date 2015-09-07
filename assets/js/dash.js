import 'material-design-lite';
import $ from 'jquery';
import _ from 'underscore';
import Radio from 'backbone.radio';
import {Application} from 'backbone.marionette';

import './templates/manager';
import AppLayout from './layouts/app';

const App = Application.extend({
    initialize() {
        this.layout = new AppLayout();
        this.layout.render();
    }
});

new App();
