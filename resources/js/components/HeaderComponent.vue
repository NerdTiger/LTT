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
                    <a class="dropdown-item" href="#" @click.prevent="logout" >log out</a>
                    
                </div>
          </div>
        </div>
    </div>
    <div class="row" >
        
        <div v-if="usertypeid==1"><UserMenuitems></UserMenuitems></div>
        <div v-if="usertypeid==2"><ClientmanagerMenuitems></ClientmanagerMenuitems></div>
        <div v-if="usertypeid==5"><TTAdminMenuitems></TTAdminMenuitems></div>

        <!-- <select-square></select-square>
        <template id="select-square">
        <input type="text" v-model="usertypeid">
        </template> -->

        </div>   
    <!-- <div class="row card-body" >
        <div v-if="usertypeid==5"><TTAdminProjectIndexComponent></TTAdminProjectIndexComponent></div>
        <div v-if="usertypeid==2"><ClientManagerProjectIndexComponent></ClientManagerProjectIndexComponent></div>
        <div v-if="usertypeid==1"><UserProjectIndexComponent></UserProjectIndexComponent></div>
     </div>            -->
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
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        created() {
            let uri = '/api/login/getuserlogininfo';
            this.axios.get(uri).then(response => {
                this.login=response.data.login; 
                this.authorises=response.data.authorises; 
                this.current_user_type=response.data.current_user_type; 
            });
            },
        mounted() {
                    console.log('Header Component mounted.');

                },
methods: {
      logout:function(){
               axios.post('logout').then(response => {
                  if (response.status === 302 || 401) {
                    console.log('logout');
                  }
                  else {
                    // throw error and go to catch block

                  }
                }).catch(error => {

              });
            },
    changemenu(usertypeid){
        this.usertypeid=usertypeid;
        }
    }
    }
</script>





