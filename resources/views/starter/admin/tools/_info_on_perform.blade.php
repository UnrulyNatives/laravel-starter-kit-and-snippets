


    @if(!isset($perform)) 
        <div class="communique-danger communique-cleared" id="">
            <h4>Czy wiesz, co robisz?!</h4>
            <p>Uruchomienie narzędzia wykonuje się przez dodanie <code>?perform=1</code> do URL. Kliknij na poniższy guzik:

            <a href="{{ URL::to(Request::url().'?perform=1') }}" class="btn btn-danger" target="_blank">
              <i class="fa fa-start"></i>
              PERFORM
            </a></p>

        </div>
    @elseif(isset($perform) && $perform == 1)

        <div class="communique-info communique-cleared" id="">
            <h4>Odpaliło się! </h4>
            <p>Powinieneś widzieć rezultat!</p>

            itemstobeacteduponbefore: {{@$itemstobeacteduponbefore}}
            Affected: {{$affected}}
            itemstobeacteduponafter: {{@$itemstobeacteduponafter}}

        </div>

	   
    @endif
