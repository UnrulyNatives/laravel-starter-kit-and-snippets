


    @if(!isset($perform)) 
        <div class="communique-danger communique-cleared" id="">
            <h4>Are you sure you know what you are doing?!</h4>
            <p>You can trigger this admin tool by adding extra parameter to URL: <code>?perform=1</code>. Just click this button:

            <a href="{{ URL::to(Request::url().'?perform=1') }}" class="btn btn-danger" target="_blank">
              <i class="fa fa-start"></i>
              PERFORM
            </a></p>

        </div>
    @elseif(isset($perform) && $perform == 1)

        <div class="communique-danger communique-cleared" id="">
            <h4>It worked!</h4>
            <p>You should be able to see the results!</p>

            itemstobeacteduponbefore: {{@$itemstobeacteduponbefore}}
            Affected: {{$affected}}
            itemstobeacteduponafter: {{@$itemstobeacteduponafter}}

        </div>

	   
    @endif
