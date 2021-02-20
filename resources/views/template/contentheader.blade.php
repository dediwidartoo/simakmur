<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    @yield('title_header')
        <small>@yield('desc_header')</small>
    </h1>
    <ol class="breadcrumb">
        @yield('breadcrumb')
        {{-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li> --}}
    </ol>
</section>