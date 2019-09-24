<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
<select class="form-control" v-model="screens" number>
    <option>1</option>
    <option>2</option>
    <option>3</option>
</select>

<div v-for="screen in screens">
    <select-square></select-square>
</div>

<template id="select-square">
    <select class="form-control" v-model="squares" number>
        <option>1</option>
        <option>2</option>
        <option>3</option>
    </select>
    <square-template v-for="square in squares"></square-template>
</template>

<template id="square-template">
    <input>
</template>

<script>
Vue.component('select-square', {
    template:'#select-square',
    components:{
        'square-template' : {
            template: '#square-template'
        }
    }
});

new Vue({
    el: 'body',

    data: {
        screens:'',
    }
});
</script>