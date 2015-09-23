<!DOCTYPE html>
<html lang=en>
    <head>
        @include('Frontend.includes.head')
        @yield('mystyles')
    </head>
    <body id=top>
        <a href="#top" id=up data-spy=affix data-offset=100><span class="fa fa-caret-up"></span></a> 
        @include('Frontend.includes.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('Frontend.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        @include('Frontend.includes.footer')
        @include('Frontend.includes.foot')
        @yield('myscripts')
    </body>
</html>
