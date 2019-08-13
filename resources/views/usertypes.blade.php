

        <a class="dropdown-item" >
        @foreach($uts as $ut )
        
        <a class="nav-link" >{{$ut['user_type_name']}}</a>
                {{-- route('usertype.user')--}}
              @endforeach  

            
            </a>


