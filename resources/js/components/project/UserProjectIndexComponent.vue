// UserProjectIndexComponent.vue

<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header">UserProjectIndexComponent</div>

              <div class="card-body">
                  UserProjectIndexComponent
                  {{name_str}}
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
      let uri = '/api/project/index';
      this.axios.get(uri).then(response => {
        this.name_str = response.data;
      });
      
    }
  }
</script>