import Router from './router';
import NavbarService from '../services/navbar';
import HeaderService from '../services/header';
import ProtectedRoute from '../routes/protected-route';
import SectionsCollection from '../collections/menu-sections';
import SectionModel from '../models/menu-section';
import ItemsCollection from '../collections/menu-items';
import ShowSectionsView from'../views/menu-sections/show-all';
import ShowSectionView from '../views/menu-sections/show';
import SectionEditView from '../views/menu-sections/edit';

export default Router.extend({
    navName: 'menu-sections',
    routes: {
        'menu-sections': 'showSections',
        'menu-section/:id': 'showSection',
        'menu-section/:id/edit': 'editSection',
    },

    initialize() {
        this.sections = new SectionsCollection();
    },

    showSections() {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Menu Sections');

        return new ProtectedRoute(new ShowSectionsView({collection: this.sections}));
    },

    showSection(id) {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Menu Section');
        const model = this.sections.get(id) || new SectionModel({id});
        const collection = new ItemsCollection();

        return new ProtectedRoute(new ShowSectionView({model, collection}));
    },

    editSection(id) {
        NavbarService.setContentActive(this.navName);
        HeaderService.setTitle('Edit Menu Section');
        const model = this.sections.get(id) || new SectionModel({id});

        return new ProtectedRoute(new SectionEditView({model}));
    },
});
