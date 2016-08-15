{!! Html::style('css/select2.css') !!}
{!! Html::script('js/select2.min.js') !!}
{!! Html::script('js/select2_language_pl.js') !!}

{!! Html::script('js/apply_select2.js') !!}
    <script>
        $(document).ready(function() { $("select").select2(); });
    </script>