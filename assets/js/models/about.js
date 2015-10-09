import Model from './model';

export default Model.extend({
    resourceName: 'about',
    defaults: {
        title: '',
        content: '',
    },
});
