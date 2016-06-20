import Collection from './collection';
import MenuSectionModel from '../models/menu-section';

export default Collection.extend({
    resourceName: 'menu-section',
    model: MenuSectionModel,
    comparator: 'sort_id',
});
