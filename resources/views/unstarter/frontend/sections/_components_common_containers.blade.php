<h2>UNIVERSAL Containers and boxes</h2>

<?php
$boxes = ['un_container','un_block','un_box','un_objectbox','un_object','un_quote','un_identity','un_developer','un_choices','un_presenter','un_sorted','un_sorted2']
?>
  
<div class="csch_dark2">
@foreach($boxes as $box)
         <div class="{{$box}} csch_dark{{rand(1,7)}}">
                <img src="{{URL::to('avatars/_empty_user.jpg')}}"
                    <h2>h2 {{$box}}</h2>
                    <h4>h4 {{$box}}</h4>
                    <p>A paragraph of text</p>



        </div>
@endforeach
</div>
<h2>TAILORED Containers and boxes</h2>


un_user
un_minibox
un_minipack
un_select
un_judgement
box_judgestandpoint
un_corner
un_statistic
un_errors
un_profile
                            <h2>MODIFIERS flexh</h2>

<!-- theme: Fawkes semantic-ui f:f -->
un_wide16

un_wide24
        
un_flex
un_flex_vt
un_flex_vc
un_flex_vs
un_flex_ht
un_flex_hc
un_flex_hs

widefull

padding1
padding2


                    <h2>in production</h2>



 
                            <h4>box_quote</h4>
                            <h4>box_profile</h4>
                            <h4>box_user</h4>

                            box_tags

                            box_judgement
