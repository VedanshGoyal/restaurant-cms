import Collection from './collection';
import HourModel from '../models/hour';

export default Collection.extend({
    resourceName: 'hour',
    model: HourModel,
    comparator: 'id',
});
