import Model from './model';

export default Model.extend({
    resourceName: 'menu-item',
    defaults: {
        'section_id': 0,
        'sort_id': 0,
        name: '',
        description: '',
        'price_one': '',
        'price_two': null,
    },
});
