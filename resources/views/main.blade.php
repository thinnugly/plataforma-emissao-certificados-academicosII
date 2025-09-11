<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <!--<i class="fas fa-user-circle"></i>
            <div class="logo_name">{{ Auth::user()->name }}</div>-->
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fa fa-fw fa-user-circle"></i>{{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-sign-out"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </div>
       <!-- <i class="fas fa-bars" id="btn"></i>-->
    </div>
    <ul class="nav_list">
        <li class="list_item">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Pesquisar...">
            <span class="tooltips">Search</span>
        </li>
        @if(Auth::user()->hasRole('administrator'))
            <li class="list_item active">
                <a href="/administrator" class="active">
                    <i class="fas fa-home"></i>
                    <span class="links_name">Página inical</span>
                </a>
                <span class="tooltips">Home</span>
            </li>
            <li class="list_item">
                <a href="/administrator/usuarios">
                    <i class="fas fa-users"></i>
                    <span class="links_name">Usuários</span>
                </a>
                <span class="tooltips">Usuários</span>
            </li>
            <li class="list_item">
                <a href="/administrator/estudantes">
                    <i class="fa fa-people-line"></i>
                    <span class="links_name">Estudantes</span>
                </a>
                <span class="tooltips">Estudantes</span>
            </li>
            <li class="list_item">
                <a href="/administrator/disciplinas">
                    <i class="fa fa-archive"></i>
                    <span class="links_name">Alocar disciplinas</span>
                </a>
                <span class="tooltips">disciplinas</span>
            </li>
            <li class="list_item">
                <a href="/administrator/professores">
                    <i class="fa fa-people-line"></i>
                    <span class="links_name">Professores</span>
                </a>
                <span class="tooltips">Professor</span>
            </li>
            <li class="list_item">
                <a href="/administrator/funcionarios">
                    <i class="fa fa-people-line"></i>
                    <span class="links_name">Funcionários</span>
                </a>
                <span class="tooltips">Funcionários</span>
            </li>
        @endif
        @if(Auth::user()->hasRole('office'))
            <li class="list_item active">
                    <a href="/office" class="active">
                        <i class="fas fa-home"></i>
                        <span class="links_name">Página inical</span>
                    </a>
                    <span class="tooltips">Home</span>
                </li>
            <li class="list_item">
                <a href="/office/exames">
                    <i class="fas fa-archive"></i>
                    <span class="links_name">Exames</span>
                </a>
                <span class="tooltips">Certificados</span>
            </li>
            <li class="list_item">
                <a href="/office/certificados">
                    <i class="fas fa-archive"></i>
                    <span class="links_name">Certificados</span>
                </a>
                <span class="tooltips">Certificados</span>
            </li>
            <li class="list_item">
                <a href="/office/gestordeficheiros">
                    <i class="fas fa-folder"></i>
                    <span class="links_name">Gestor de ficheiro</span>
                </a>
                <span class="tooltips">File manager</span>
            </li>
        @endif 
        @if(Auth::user()->hasRole('student'))
            <li class="list_item active">
                    <a href="/student" class="active">
                        <i class="fas fa-home"></i>
                        <span class="links_name">Página inical</span>
                    </a>
                    <span class="tooltips">Home</span>
                </li>
            <li class="list_item">
                <a href="/student/certificado">
                    <i class="fas fa-archive"></i>
                    <span class="links_name">Emitir certificado</span>
                </a>
                <span class="tooltips">Certificados</span>
            </li>
        @endif
        @if(Auth::user()->hasRole('director'))
            <li class="list_item active">
                    <a href="/director" class="active">
                        <i class="fas fa-home"></i>
                        <span class="links_name">Página inical</span>
                    </a>
                    <span class="tooltips">Home</span>
                </li>
            <li class="list_item">
                <a href="/director/certificados">
                    <i class="fas fa-archive"></i>
                    <span class="links_name">Certificados</span>
                </a>
                <span class="tooltips">Certificados</span>
            </li>
            <li class="list_item">
            <a href="/director/gestordeficheiros">
                <i class="fas fa-folder"></i>
                <span class="links_name">Gestor de ficheiro</span>
            </a>
            <span class="tooltips">File manager</span>
        </li>
        @endif 
        @if(Auth::user()->hasRole('professor'))
            <li class="list_item active">
                    <a href="/professor" class="active">
                        <i class="fas fa-home"></i>
                        <span class="links_name">Página inical</span>
                    </a>
                    <span class="tooltips">Home</span>
                </li>
            <li class="list_item">
                <a href="/professor/lancarnota">
                    <i class="fas fa-archive"></i>
                    <span class="links_name">Lançam. de notas</span>
                </a>
                <span class="tooltips">Notas</span>
            </li>
            <li class="list_item">
                <a href="/professor/pautas">
                    <i class="fas fa-archive"></i>
                    <span class="links_name">Pautas oficiais</span>
                </a>
                <span class="tooltips">Pautas</span>
            </li>
        @endif
        <li class="list_item">
            <a href="#">
                <i class="fas fa-pie-chart"></i>
                <span class="links_name">Análise</span>
            </a>
            <span class="tooltips">Analystics</span>
        </li>
        <li class="list_item">
            <a href="#">
                <i class="fas fa-link"></i>
                <span class="links_name">Paginas</span>
            </a>
            <span class="tooltips">Paginas</span>
        </li>
        <li class="list_item">
            <a href="#">
                <i class="fas fa-stream"></i>
                <span class="links_name">Mensagens</span>
            </a>
            <span class="tooltips">Mensagens</span>
        </li>
        <li class="list_item">
            <a href="#">
                <i class="fas fa-cog"></i>
                <span class="links_name">Configurações</span>
            </a>
            <span class="tooltips">Configuracoes</span>
        </li>
        <li class="list_item">
            <a href="#">
                <i class="fas fa-sliders-h"></i>
                <span class="links_name">Serviços</span>
            </a>
            <span class="tooltips">Servicos</span>
        </li>
    </ul>
    <div class="profile_content">
        <div class="profile">

        </div>
    </div>
</div>
<script src="{{asset('site/jquery.js')}}"></script>
<script type="text/javascript">
    /*let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let searchBtn = document.querySelector(".fa-search");

    btn.onclick = function (){
        sidebar.classList.toggle("active");
    }
    searchBtn.onclick = function (){
        sidebar.classList.toggle("active");
    }*/
</script>
