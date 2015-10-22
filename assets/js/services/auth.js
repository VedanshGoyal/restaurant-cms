import AuthModel from '../models/auth';

class AuthService {
    constructor() {
        this.model = new AuthModel();
    }

    isAuthed() {
        return this.model.hasValidSession();
    }

    headers() {
        const headers = {};

        headers.Authorization = `Bearer ${this.model.get('token')}`;
        return headers;
    }

    logout() {
        this.model.clearStorage();
        window.location.hash = 'login';
    }
}

export default new AuthService();
