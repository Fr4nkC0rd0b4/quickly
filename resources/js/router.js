import Vue from 'vue'
import Router from 'vue-router'
import DashboardComponent from './views/DashboardComponent.vue'
import CreateDeliveryComponent from './views/delivery/CreateDeliveryComponent.vue'
import TableComponent from './components/TableComponent.vue'
import TestComponent from './components/TestComponent.vue'
import ChatComponent from './components/ChatComponent.vue'
import ProfileComponent from './views/profile/ProfileComponent.vue'
import ProfileEditComponent from './views/profile/ProfileEditComponent.vue'
import UserForm from './views/register/UserForm.vue'

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
			path:'/spa/delivery/create',
			name:'delivery.create',
			component:CreateDeliveryComponent
		},
		{
			path:'/spa/table',
			name:'table',
			component:TableComponent
		},
		{
			path:'/spa/account/profile',
			name:'account.profile',
			component:ProfileComponent
		},
		{
			path:'/spa/account/profile/edit',
			name:'account.profile.edit',
			component:ProfileEditComponent
		},
		{
			path:'/test/register/user',
			name:'register.complete.user',
			component:UserForm
		},
		{
			path:'/test/chat',
			name:'test.chat',
			component:ChatComponent
		}
	]
})