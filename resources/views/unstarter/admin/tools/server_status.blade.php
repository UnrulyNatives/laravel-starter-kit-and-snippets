@extends('unstarter.layouts.master_bootstrap_simple')

@section('content')


    @include('unstarter.admin.tools._admintools')



<h1>server_status</h1>

    @include('unstarter.admin.segments.site_statement')

    <?php


phpinfo();
?>

@stop








