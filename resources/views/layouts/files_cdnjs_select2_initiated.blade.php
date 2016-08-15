{!! Html::style('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css') !!}
{!! Html::script('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js') !!}
{!! Html::script('js/select2_language_pl.js') !!}
{!! Html::script('js/apply_select2.js') !!}
    <script>
        $(document).ready(function() { $("select").select2(); });
    </script>