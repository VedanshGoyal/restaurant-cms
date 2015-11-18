import {ItemView, TemplateCache} from 'backbone.marionette';
import LoadingService from '../../services/loading';
import NotifyService from '../../services/notify';
import MDLBehavior from '../../behaviors/mdl';
import ModelErrorBehavior from '../../behaviors/model-error';

export default ItemView.extend({
    template: TemplateCache.get('photoCreate'),
    className: 'mdl-card mdl-cell mdl-cell--8-col mdl-shadow--2dp',
    tagName: 'div',

    ui: {
        fileInput: 'input[type=file]',
        img: 'img',
        form: 'form',
    },

    events: {
        'submit form': 'handleSubmit',
        'click .photo-add-btn': 'uploadPrompt',
        'change input[type=file]': 'setPreview',
    },

    behaviors: {
        mdl: {behaviorClass: MDLBehavior},
        modelError: {behaviorClass: ModelErrorBehavior},
    },

    uploadPrompt() {
        this.ui.fileInput.click();
    },

    setPreview(event) {
        const targetEl = event.target;
        const file = targetEl.files[0];
        const fileReader = new FileReader();
        const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];
        const maxSize = 10 * 1000 * 1000;

        if (allowedTypes.indexOf(file.type) < 0 || file.size > maxSize) {
            NotifyService.error('Photo must be .jpg, .jpeg or .png and less than 10mb');
            this.ui.form[0].reset();

            return;
        }

        fileReader.onload = () => this.ui.img[0].src = fileReader.result;
        fileReader.readAsDataURL(file);
    },

    handleSubmit(event) {
        event.preventDefault();
        const file = this.ui.fileInput[0].files[0];
        const formData = new FormData();

        if (!file) {
            return;
        }

        LoadingService.show();
        formData.append('image', file);
        this.model.save({}, {data: formData, processData: false, contentType: false}).done(() => {
            LoadingService.hide();
            NotifyService.success('Photo successfully added');

            window.location.hash = 'photos';
        });
    },
});
