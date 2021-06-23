import Vue from 'vue'
import Router from 'vue-router'

//Components
import DashboardComponent from './components/DashboardComponent.vue'
import TableComponent from './components/TableComponent.vue'
import TestComponent from './components/TestComponent.vue'

//Views
import CreateDelivery from './views/delivery/Create.vue'
import Delivery from './views/delivery/Delivery.vue'
import CreateTravel from './views/travel/Create.vue'
import Travel from './views/travel/Travel.vue'
import Profile from './views/profile/Profile.vue'
import ProfileEdit from './views/profile/Edit.vue'

Vue.use(Router)

export default new Router({
	mode:'history',
	routes:[
		{
			path:'/home',
			name:'home',
			component:DashboardComponent
		},
		{
			path:'/spa/delivery',
			name:'delivery',
			component:Delivery
		},
		{
			path:'/spa/delivery/create',
			name:'delivery.create',
			component:CreateDelivery
		},
		{
			path:'/spa/travel',
			name:'travel',
			component:Travel
		},
		{
			path:'/spa/travel/create',
			name:'travel.create',
			component:CreateTravel
		},
		{
			path:'/spa/table',
			name:'table',
			component:TableComponent
		},
		{
			path:'/spa/account/profile',
			name:'account.profile',
			component:Profile
		},
		{
			path:'/spa/account/profile/edit',
			name:'account.profile.edit',
			component:ProfileEdit
		}
	]
})