import Router from './router';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import ProtectedRoute from '../routes/protected-route';

export default Router.extend({
    navName: 'menu-sections',
    routes: {
        'menu-sections': 'showSections',
        'menu-section/:id': 'showSection',
        'menu-section/:id/edit': 'editSection',
        'menu-item/:id': 'showItem',
        'menu-item/:id/edit': 'editItem',
    },

    showSections() {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Menu Sections');

    },

    showSection(id) {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Menu Section');

    },

    editSection(id) {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Edit Menu Section');

    },

    showItem(id) {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Menu Section Item');

    },

    editItem(id) {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Edit Menu Section Item');

    },
});
