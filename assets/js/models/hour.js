import Model from './model';

export default Model.extend({
    resourceName: 'hour',
    defaults: {
        day: '',
        open: '',
        close: '',
        'is_closed': false,
    },
});
