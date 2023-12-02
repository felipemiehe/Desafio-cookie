import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import HomeComponent from './pages/home/HomeComponent'
// import Vuelidate from 'vuelidate'
import axios from 'axios'


axios.defaults.baseURL= 'http://127.0.0.1:8000/api';


Vue.config.productionTip = false
Vue.use(VueRouter);
// Vue.use(Vuelidate); // iria fazer pela biblieteca porem fiquei sem tempo fiz por JS mesmo no methods

const routes = [
  { path: '/', name:'home', component: HomeComponent },  
]

const router = new VueRouter({
  routes // short for `routes: routes`
})

new Vue({
  router,  
  render: h => h(App),
}).$mount('#app')
