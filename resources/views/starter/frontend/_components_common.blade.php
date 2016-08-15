<h2>CSS Elements </h2>

<p>The file to edit: <strong>common_elements.less</strong></p>
<p>It renders into <strong>common_elements.css</strong></p>

<div class="communique-info communique-lg">  
    <p>You can use any rendering solution. I use 
        <a href="http://winless.org/" class="btn" target="_blank">
          
          Winless
        </a>.

    </p>
</div>




<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Communiques (Messages)</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Buttons</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Containers and boxes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Color schemes</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel">
        @include('starter.frontend.sections._components_common_communique')
  </div>
  <div class="tab-pane" id="profile" role="tabpanel">

        @include('starter.frontend.sections._components_common_buttons')
  </div>
  <div class="tab-pane" id="messages" role="tabpanel">

        @include('starter.frontend.sections._components_common_containers')
  </div>
  <div class="tab-pane" id="settings" role="tabpanel">

        @include('starter.frontend.sections._components_common_colorschemes')
  </div>
</div>




<hr>






<div class="communique-danger communique-clean">
    <strong>Theme: {{ \Theme::get()}}.
    <p>Some elements change their appearance under a new framework. Make sure you switched to the right framework

        <a href="{{URL::to('set_theme/Bootstrap')}}" title="Fallback theme (Bootstrap)">
          Bootstrap (Fallback)
        </a>

        <a href="{{URL::to('set_theme/UIKit')}}" title="(UI-KIT)">
          UIKit
        </a>
       <a href="{{URL::to('set_theme/Semantic')}}" title="(SemanticUI">
         Semantic
        </a></p>
</div>

