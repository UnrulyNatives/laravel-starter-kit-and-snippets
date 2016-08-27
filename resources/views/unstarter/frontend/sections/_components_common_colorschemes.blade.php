

    <h2>Color schemess</h2>



    <div class="un_flex un_flex_hs un_flex_wrap">
       <div>
          <h2>Dark</h2>
          <?php
          $name = 'dark';
          ?>
          @foreach([1,2,3,4,5,6,7,8] as $count)
             <div class="un_box csch_{{$name}}{{$count}}">
                  <h4>csch_{{$name}}{{$count}}</h4>
                  <p>A paragraph of text</p>
              </div>
          @endforeach 
       </div>
       <div class="">
          <h2>Bright</h2>
          <?php
          $name = 'bright';
          ?>
          @foreach([1,2] as $count)

             <div class="un_box csch_{{$name}}{{$count}}">
                  <h4>csch_{{$name}}{{$count}}</h4>
                  <p>A paragraph of text</p>
              </div>
          @endforeach           
     </div>
     <div class="csch_dark4">
          <h2>subtle</h2>
          <?php
          $name = 'subtle';
          ?>
          @foreach([1,2,3,4] as $count)

             <div class="un_box csch_{{$name}}{{$count}}">
                  <h4>csch_{{$name}}{{$count}}</h4>
                  <p>A paragraph of text</p>
              </div>
          @endforeach           
    </div>
     <div class="csch_bright4">
          <h2>subtle</h2>
          <?php
          $name = 'subtle';
          ?>
          @foreach([1,2,3,4] as $count)

             <div class="un_box csch_{{$name}}{{$count}}">
                  <h4>csch_{{$name}}{{$count}}</h4>
                  <p>A paragraph of text</p>
              </div>
          @endforeach           
    </div>
     <div class="csch_dark4">
          <h2>shadow</h2>
          <?php
          $name = 'shadow';
          ?>
          @foreach([1,2,3] as $count)

             <div class="un_box csch_dark1 un_{{$name}}{{$count}}">
                  <h4>csch_{{$name}}{{$count}}</h4>
                  <p>A paragraph of text</p>
              </div>
          @endforeach           
    </div>
</div>






