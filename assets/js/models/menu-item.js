import Model from './model';

export default Model.extend({
    resourceName: 'menu-item',
    defaults: {
        sortId: 1,
        name: '',
        description: '',
        priceOne: '',
        priceTwo: null,
        tags: [],
    },
});
