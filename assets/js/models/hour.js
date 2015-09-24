import Model from './model';
import Config from '../config';

export default Model.extend({
    resourceName: 'hour',
    defaults: {
        day: '',
        open: '',
        close: '',
        isClosed: false,
    },
});
