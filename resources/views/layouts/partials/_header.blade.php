    <header class="pageHeader my-4 pb-0">
      <h1><span itemprop="name">{{$headerText}}</span>
        @isset($headerSub)<small itemprop="disambiguatingDescription" class="text-muted d-flex flex-column ml-4 mt-1">{{$headerSub}}</small>@endisset
      </h1>
      <div class="shareIcons ml-auto">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank" title="Поделиться в FB">
        <img src="{{ asset('/images/icons/facebook.svg') }}" height="25" width="25">
        </a>

        <img src="{{ asset('/images/icons/vk.svg') }}" height="25" width="25">
        <img src="{{ asset('/images/icons/ok.svg') }}" height="25" width="25">
      </div>
    </header>