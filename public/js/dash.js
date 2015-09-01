import 'material-design-lite';
import $ from 'jquery';
import _ from 'underscore';
import Backbone from 'backbone';
import Marionette from 'backbone.marionette';

class App extends Marionette.Application {
    constructor() {
        super();
        console.log('app init');
    }
}

export default App;
