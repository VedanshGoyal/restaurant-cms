import Model from './model';

export default Model.extend({
    resourceName: 'info',
    defaults: {
        name: '',
        street: '',
        city: '',
        state: '',
        zip: '',
        'phone_one': '',
        'phone_two': null,
    },
});
