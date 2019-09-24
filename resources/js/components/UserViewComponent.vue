// UserViewComponent.vue
<template>

  <div class="row justify-content-center">

      <div class="col-md-12">
          <div class="card card-default">
          </div>
      </div>
  </div>
</template>

<script>
console.log('genedate user view page');

import ClientmanagerMenuitems from './menuitems/clientmanager_menuitems_Component.vue';
import UserMenuitems from './menuitems/user_menuitems_Component.vue';
import TTAdminMenuitems from './menuitems/ttadmin_menuitems_Component.vue';
window.Vue = require('vue');
Vue.component('ClientmanagerMenuitems', ClientmanagerMenuitems);
Vue.component('UserMenuitems', UserMenuitems);
Vue.component('TTAdminMenuitems', TTAdminMenuitems);

export default {


 
created(){
    
},
mounted() {
    console.log('mount userview component');
        },
methods: {
    
    }
}
</script>    
