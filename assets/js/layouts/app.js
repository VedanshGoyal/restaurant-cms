import {LayoutView, TemplateCache} from 'backbone.marionette';

export default LayoutView.extend({
    el: '.application',
    template: TemplateCache.get('app'),
    regions: {
        content: '.content',
    },
});
