import Vue from 'vue'
import Router from 'vue-router'
import ExampleComponent from './components/ExampleComponent.vue'
import TableComponent from './components/TableComponent.vue'
import ProfileComponent from './components/profile/ProfileComponent.vue'
import ProfileEditComponent from './components/profile/ProfileEditComponent.vue'

Vue.use(Router)

export default new Router({
	mode:'history',
	routes:[
		{path:'/home',name:'home',component:ExampleComponent},
		{path:'/vue/table',name:'table',component:TableComponent},
		{path:'/vue/profile',name:'profile',component:ProfileComponent},
		{path:'/vue/profile/edit',name:'profile',component:ProfileEditComponent},
	]
})