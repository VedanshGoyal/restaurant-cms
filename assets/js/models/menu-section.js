import Model from './model';

export default Model.extend({
    resourceName: 'menu-section',
    defaults: {
        sizes: 1,
        'sort_id': 0,
        name: '',
        'info_title': '',
        info: '',
    },
});
