@extends('starter.layouts.master_bootstrap_simple')

@section('content')


        <a  href="{{URL::to('admin/server-status')}}" class="ui button" target="_blank">
        <i class="bar chart icon icon"></i>
        PHP & Server status
        </a>

        @include('starter.frontend._header')


        <div class="un_flex un_flex_ht">
           <aside>
               @include('starter.frontend._table_of_contents')
           </aside>
           <article id="placeholder_main" class="csch_subtle3 m-a-1">


 

        @include('starter.frontend._components_common')


           </article>
        </div>




        </ul>
    </div>

    @if(Auth::check() )

    
    @else

        @include('segments._notice_developers_only')

    @endif

@stop




@push('css')


@endpush


@push('scripts_in_tail')

<script>

    $(document).ready(function(){


        // initializing the tab menu Bootstrap
        $('#tab-nav a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })

        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })


    });
</script>


@endpush