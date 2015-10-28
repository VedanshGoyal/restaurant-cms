import Model from './model';

export default Model.extend({
    resourceName: 'menu-item',
    defaults: {
        sectionId: 0,
        sortId: 0,
        name: '',
        description: '',
        priceOne: '',
        priceTwo: null,
    },
});
