// ProjectListComponent.vue

<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header">entry list Component</div>

              <div class="card-body">
                  <!-- {{projects}} -->
              </div>
          </div>
      </div>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          projects: [],
          name_str:""
        }
      },
      created() {
      // let uri = '/api/project/listproject';
      //  this.axios.get(uri).then(response => {
      //    this.projects = response.data;
      //    console.log(this.projects.length);
      // });
      
    }
  }
</script>