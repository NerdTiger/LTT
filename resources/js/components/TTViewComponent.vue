// TTViewComponent.vue

<template>
  <div class="container" >
    
    
       <HeaderComponent></HeaderComponent>

   <transition name="fade"> 
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>
  /* @import './public/css/tt_custom.css';  */
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
  

</style>

<style>
.header{

background-color: rgba(0,113,190,1);
font-family: calibri;

}

</style>
<script>
console.log('TTView.vue is imported');
    export default{
    data(){
        return {
loginusername:"zhi jun zhang",
count:0,
login:[],
project:[],
        }
    },
 created() {
   console.log('TTView.vue created');
      let uri = '/api/project/index';
      // this.axios.get(uri).then(response => {
      //    this.login=response.data.login; 
      //    this.project=response.data.project; 
         
      // });
    },
mounted() {
            console.log('TTViewComponent.vue mounted.');

        },
    }

</script>