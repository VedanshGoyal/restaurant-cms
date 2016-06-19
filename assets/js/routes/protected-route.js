import Route from './route';
import AuthService from '../services/auth';

class ProtectedRoute extends Route {
    enter() {
        if (AuthService.isAuthed()) {
            this.render();
        } else {
            window.location.hash = 'login';
        }
    }
}

export default ProtectedRoute;
