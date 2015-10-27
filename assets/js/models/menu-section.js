import Model from './model';

export default Model.extend({
    resourceName: 'menu-section',
    defaults: {
        sizes: 1,
        sortId: 1,
        name: '',
        infoTitle: '',
        info: '',
    },
});
