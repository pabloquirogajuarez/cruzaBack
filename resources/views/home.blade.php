@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">VDV Cooperativa</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @php
                        use App\Models\Empresa;
                        use App\Models\Socio;
                        use App\Models\Vendedor;

                        $cant_empresas = Empresa::count(); 
                        $cant_socios = Socio::count(); 
                        $cant_vendedores = Vendedor::count(); 
                    @endphp

                    @foreach([
                        ['color' => '36454F', 'title' => 'Gestion de empresas', 'description' => 'Control de lista de empresas', 'count' => $cant_empresas, 'icon' => 'fa-id-card', 'link' => '/empresas'],
                        ['color' => '3399ff', 'title' => 'Socios', 'description' => 'Control de lista de socios', 'count' => $cant_socios, 'icon' => 'fa-users', 'link' => '/socios'],
                        ['color' => '339966', 'title' => 'Vendedores', 'description' => 'Control de lista de vendedores', 'count' => $cant_vendedores, 'icon' => 'fa-users', 'link' => '/vendedores']
                    ] as $card)
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card shadow-sm" style="background-color: #{{ $card['color'] }}; border-radius: 15px;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="text-white">{{ $card['title'] }}</h5>
                                        <p class="text-white mb-0">{{ $card['description'] }}</p>
                                        <h2 class="text-white">{{ $card['count'] }} en total</h2>
                                    </div>
                                    <div class="icon">
                                        <i class="fa {{ $card['icon'] }} fa-4x text-white"></i>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ $card['link'] }}" class="btn btn-dark">Ver más &raquo;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Administrar sistema</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @php
                        use App\Models\Blog;
                        use App\Models\User;
                        use Spatie\Permission\Models\Role;

                        $cant_blogs = Blog::count(); 
                        $cant_usuarios = User::count(); 
                        $cant_roles = Role::count(); 
                    @endphp

                    @foreach([
                        ['color' => '9933ff', 'title' => 'Usuarios del sistema', 'description' => 'Control de usuarios de la página', 'count' => $cant_usuarios, 'icon' => 'fa-users', 'link' => '/usuarios'],
                        ['color' => '33cc33', 'title' => 'Roles del sistema', 'description' => 'Control de permisos de la página', 'count' => $cant_roles, 'icon' => 'fa-user-shield', 'link' => '/roles']
                    ] as $card)
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow-sm" style="background-color: #{{ $card['color'] }}; border-radius: 15px;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="text-white">{{ $card['title'] }}</h5>
                                        <p class="text-white mb-0">{{ $card['description'] }}</p>
                                        <h2 class="text-white">{{ $card['count'] }}</h2>
                                    </div>
                                    <div class="icon">
                                        <i class="fa {{ $card['icon'] }} fa-4x text-white"></i>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ $card['link'] }}" class="btn btn-dark mt-2">Ver más &raquo;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
