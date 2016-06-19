import Model from './model';

export default Model.extend({
    resourceName: 'info',
    defaults: {
        name: '',
        street: '',
        city: '',
        state: '',
        zip: '',
        phoneOne: '',
        phoneTwo: null,
    },
});
