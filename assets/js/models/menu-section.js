import Model from './model';

export default Model.extend({
    resourceName: 'menu-section',
    defaults: {
        sizes: 1,
        sortId: 0,
        name: '',
        infoTitle: '',
        info: '',
    },
});
