import Vue from 'vue'
import Router from 'vue-router'
import DashboardComponent from './components/DashboardComponent.vue'
import CreateDeliveryComponent from './components/delivery/CreateDeliveryComponent.vue'
import TableComponent from './components/TableComponent.vue'
import ProfileComponent from './components/profile/ProfileComponent.vue'
import ProfileEditComponent from './components/profile/ProfileEditComponent.vue'
import LocationsEditComponent from './components/profile/LocationsEditComponent.vue'
import PaymentEditComponent from './components/profile/PaymentEditComponent.vue'

Vue.use(Router)

export default new Router({
	mode:'history',
	routes:[
		{path:'/home',name:'home',component:DashboardComponent},
		{path:'/vue/delivery/create', name:'delivery.create', component:CreateDeliveryComponent},
		{path:'/vue/table',name:'table',component:TableComponent},
		{path:'/vue/profile',name:'profile',component:ProfileComponent},
		{path:'/vue/profile/edit',name:'profile.edit',component:ProfileEditComponent},
		{path:'/vue/locations/edit',name:'locations.edit',props:true,component:LocationsEditComponent},
		{path:'/vue/:payment/edit',name:'payment.edit',props:true,component:PaymentEditComponent},
	]
})