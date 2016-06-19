import {Behavior} from 'backbone.marionette';

export default Behavior.extend({
    onRender() {
        window.componentHandler.upgradeElements(this.view.el);
    },
});
