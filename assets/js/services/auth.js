import AuthModel from '../models/auth';

class AuthService {
    constructor() {
        this.model = new AuthModel();
    }

    isAuthed() {
        if (this.model.hasValidSession()) {
            return true;
        }

        return false;
    }

    headers() {
        const headers = {};

        headers.Authorization = `Bearer ${this.model.get('token')}`;
        return headers;
    }
}

export default new AuthService();
