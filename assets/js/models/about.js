import Model from './model';
import Config from '../config';

export default Model.extend({
    resourceName: 'about',
    defaults: {
        title: '',
        content: '',
    },
});
