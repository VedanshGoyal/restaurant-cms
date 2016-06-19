import Collection from './collection';
import PhotoModel from '../models/photo';

export default Collection.extend({
    resourceName: 'photo',
    model: PhotoModel,
});
