// HomeComponent.vue

<template>
  <div class="row justify-content-center">

      <div class="col-md-12">
          <div class="card card-default">
              <div class="card-header" id="menuitem">

              </div>

              <div class="card-body">
                  I'm the project Component component.
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
 
mounted() {
            console.log('Component mounted.');
            //this.m1('kkkkk');
        },
        methods: {
            m1(ih){
                let fff=`a12345${ih}`;//apostrophe is working
                let fff2='a12345${ih}';//not working
                let fff3="a12345${ih}";//not working
console.log('sssss'+ih);
console.log(fff);console.log(fff2);console.log(fff3);
            }
        }
    }
</script>