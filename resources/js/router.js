import Vue from 'vue'
import Router from 'vue-router'

//Components
import DashboardComponent from './components/DashboardComponent.vue'
import TableComponent from './components/TableComponent.vue'
import TestComponent from './components/TestComponent.vue'

//Views
import Deliveries from './views/delivery/Deliveries.vue'
import CreateDelivery from './views/delivery/Create.vue'
import DeliveryShow from './views/delivery/Show.vue'
import CreateTravel from './views/travel/Create.vue'
import Travel from './views/travel/Travel.vue'
import Profile from './views/profile/Profile.vue'
import ProfileEdit from './views/profile/Edit.vue'
import NotFoundView from './views/NotFoundView.vue'
import Notifications from './views/Notifications.vue'

Vue.use(Router)

export default new Router({
	mode: 'history',
	routes: [
		// For not defined routes
		{
			path: '*',
			component: NotFoundView
		},
		{
			path: '/home',
			name: 'home',
			component: DashboardComponent
		},
		{
			path: '/spa/deliveries',
			name: 'deliveries',
			component: Deliveries,
			props: { status: '', message: '' }
		},
		{
			path: '/spa/delivery/create',
			name: 'delivery.create',
			component: CreateDelivery
		},
		{
			path: '/spa/delivery/:id',
			name: 'delivery.show',
			component: DeliveryShow
		},
		{
			path: '/spa/travel',
			name: 'travel',
			component: Travel
		},
		{
			path: '/spa/travel/create',
			name: 'travel.create',
			component: CreateTravel
		},
		{
			path: '/spa/table',
			name: 'table',
			component: TableComponent
		},
		{
			path: '/spa/account/profile',
			name: 'account.profile',
			component: Profile
		},
		{
			path: '/spa/account/profile/edit',
			name: 'account.profile.edit',
			component: ProfileEdit
		},
		{
			path: '/spa/notifications',
			name: 'notifications',
			component: Notifications
		}
	]
})
