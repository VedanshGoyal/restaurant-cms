import DialogPolyfill from 'dialog-polyfill/dialog-polyfill';
import {bind} from 'underscore';

class DialogService {
    constructor() {
        this.dialog = document.querySelector('dialog');
        this.title = this.dialog.getElementsByClassName('mdl-dialog__title')[0];
        this.message = this.dialog.getElementsByClassName('mdl-dialog__content')[0];
        this.confirm = this.dialog.getElementsByClassName('dialog-confirm')[0];
        this.cancel = this.dialog.getElementsByClassName('dialog-cancel')[0];
        
        if (!this.dialog.showModal) {
            DialogPolyfill.registerDialog(this.dialog);
        }
    }

    open(title, message) {
        const promise = new Promise((resolve, reject) => {
            this.title.innerHTML = title;
            this.message.innerHTML = message;
            this.dialog.showModal();

            function handleConfirm () {
                this.confirm.removeEventListener('click', handleConfirm);
                resolve();
            }

            function handleCancel () {
                this.cancel.removeEventListener('click', handleCancel);
                reject();
            }

            this.confirm.addEventListener('click', bind(handleConfirm, this));
            this.cancel.addEventListener('click', bind(handleCancel, this));
        });

        return promise;
    }

    close() {
        this.title.innerHTML = '';
        this.message.innerHTML = '';
        this.dialog.close();
    }
}

export default new DialogService();
