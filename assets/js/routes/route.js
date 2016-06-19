import DisplayService from '../services/display';

class Route {
    constructor(view) {
        this.view = view;
    }

    render() {
        DisplayService.render(this.view);
    }

    enter() {
        this.render();
    }
}

export default Route;
