import Syphon from 'backbone.syphon';
import {Behavior} from 'backbone.marionette';

export default Behavior.extend({
    events: {
        'submit form': 'handleSubmit',
    },

    handleSubmit(event) {
        event.preventDefault();
        this.view.form = Syphon.serialize(this);
    },
});
