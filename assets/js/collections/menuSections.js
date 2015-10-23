import Collection from './collection';
import MenuSectionModel from '../models/menuSection';

export default Collection.extend({
    resourceName: 'menu-section',
    model: MenuSectionModel,
    comparator: 'sortId',
});
