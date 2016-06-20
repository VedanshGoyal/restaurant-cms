import Collection from './collection';
import MenuItemModel from '../models/menu-item';

export default Collection.extend({
    resourceName: 'menu-item',
    model: MenuItemModel,
    comparator: 'sort_id',
});
