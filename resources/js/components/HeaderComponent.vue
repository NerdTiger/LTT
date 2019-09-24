    <template>
    <div class="container-fluid ">
   
    <div class="row header" >
        <div class="col-sm-3" align="left">
            <div class="container" style="padding:1px;">
                <img itemprop="image"  src="images/TT-Logo.png" alt="Logo" style="height: 70%;">
            </div>
        </div>
        <div class="col-sm-7" >
            
            
            </div>
        <div class="col-sm-2" align="right">
                            <div class='menufontstyle'>
                    {{login.loginname}}
                </div>

            <div class="dropdown" >
                <button type="button" id="button_admindropdownbutton" class="btn btn-primary dropdown-toggle menufontstyle" data-toggle="dropdown" >
                  {{current_user_type}}
                </button>
                
                <div class="dropdown-menu dropdown-menu-right" >
                    <a class="dropdown-item" @click.prevent="changemenu(auth.user_type_id)" v-for="auth in authorises" :key="auth.user_type_id">{{auth.user_type_name}}</a>
                    <!-- <div v-for="auth in authorises" :key="auth.user_type_id"> -->
                        <!-- <router-link :to="{ name: 'switchview',params:{usertypeid:auth.user_type_id} }" class="dropdown-item">{{auth.user_type_name}}</router-link> -->
                    <!-- </div> -->
                    
                <a class="dropdown-item" href="#">Sign out</a>
                </div>
          </div>
        </div>
    </div>
    <div class="row" >
        <!-- <input type="text" v-model="usertypeid"> -->
        <div v-if="usertypeid==1"><UserMenuitems></UserMenuitems></div>
        <div v-if="usertypeid==2"><ClientmanagerMenuitems></ClientmanagerMenuitems></div>
        <div v-if="usertypeid==5"><TTAdminMenuitems></TTAdminMenuitems></div>

        <!-- <select-square></select-square>
        <template id="select-square">
        <input type="text" v-model="usertypeid">
        </template> -->

        </div>   
    <div class="row card-body" >
        <!-- <input type="text" v-model="usertypeid"> -->
        <div v-if="usertypeid==5"><TTAdminProjectIndexComponent></TTAdminProjectIndexComponent></div>
        <div v-if="usertypeid==2"><ClientManagerProjectIndexComponent></ClientManagerProjectIndexComponent></div>
        <div v-if="usertypeid==1"><UserProjectIndexComponent></UserProjectIndexComponent></div>

        <!-- <select-square></select-square>
        <template id="select-square">
        <input type="text" v-model="usertypeid">
        </template> -->

        </div>           
</div>

</template>
<script>
console.log('header.vue');

export default {
    data(){
        return {
            authorises:[],
            login:[],
            current_user_type:'',
            usertypeid:0,
            }
        },
        created() {
            let uri = '/api/login/getuserlogininfo';
            this.axios.get(uri).then(response => {
                this.login=response.data.login; 
                this.authorises=response.data.authorises; 
                this.current_user_type=response.data.current_user_type; 
                console.log(this.authorises);
                
            });
            },
        mounted() {
                    console.log('Header Component mounted.');

                },
methods: {
    changemenu(usertypeid){
        this.usertypeid=usertypeid;
        //console.log($('#menuitem').length);
        //var usertypeid=this.$route.params.usertypeid; 
        /*
            if(typeof usertypeid == "undefined"){}
            else
            {
                switch(usertypeid){
                    case 1:
                    console.log(usertypeid); 
                        
                        var vm = new Vue({
                    el: '#menuitem',
                    data(){
                        return{
                            foo:100
                        }
                    },
                    template:'<UserMenuitems></UserMenuitems>'
                        });
                    break;
                    case 2:
                    console.log(usertypeid); 
                        
                        var vm = new Vue({
                    el: '#menuitem',
                    data(){
                        return{
                            foo:100
                        }
                    },
                    template:'<ClientmanagerMenuitems></ClientmanagerMenuitems>'
                        });
                    break;
                    case 5:
                    console.log(usertypeid); 
                        
                        var vm = new Vue({
                    el: '#menuitem',
                    data(){
                        return{
                            foo:100
                        }
                    },
                    template:'<ClientmanagerMenuitems></ClientmanagerMenuitems>'
                        });
                    break;

                }
            }*/
        }
    }
    }
</script>





