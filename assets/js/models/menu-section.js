import Model from './model';

export default Model.extend({
    resourceName: 'menu-section',
    defaults: {
        itemPrices: 1,
        sortId: 1,
        name: '',
    },
});
