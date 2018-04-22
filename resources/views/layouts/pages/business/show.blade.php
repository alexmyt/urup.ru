@extends('layouts.master')
@push('head_css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
  integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
  crossorigin=""/>
@endpush
@push('head_js')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
  integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
  crossorigin=""></script>
@endpush
@section('content')
   <section id="content">
      <div class="container" itemscope itemtype="http://schema.org/LocalBusiness">
         @include('layouts.partials._header',['headerText'=>$organisation->name,'headerSub'=>'Организация'])
         <article>
         <div id="organisationMap"></div>
         <script>
            var mymap = L.map('organisationMap').setView([{{$organisation->addresses[0]->lat}}, {{$organisation->addresses[0]->lon}}], 16);
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiYWxleG15dCIsImEiOiJjamVjaXVtcWcwa2t3MzNta2JsYWFjeGFwIn0.CP1SIwfr-mDVXbl_NNg9Pw',
            }).addTo(mymap);
            var marker = L.marker([{{$organisation->addresses[0]->lat}}, {{$organisation->addresses[0]->lon}}]).addTo(mymap);
            marker.bindPopup("{{$organisation->name}}<br>{{$organisation->addresses[0]->address}}").openPopup();
         </script>

         <div class="row">
            <div class="col-12 col-sm-6">
               <dl class="row my-3 organisationData">
                  <dt class="col-sm-3">Адрес</dt>
                  <dd class="col-sm-9" itemprop="address">{{$organisation->addresses[0]->address}}</dd>

                  <dt class="col-sm-3">Телефоны</dt>
                  <dd class="col-sm-9 d-flex flex-column">
                  @foreach($phones as $phone)
                     @php
                       $phoneNationalFormat = phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL);
                       $phoneCityNumber = substr($phoneNationalFormat,strLen($phoneNationalFormat)-7,7);
                     @endphp
                     <span><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}" itemprop="telephone">{{$phoneCityNumber}}</a></span>
                  @endforeach
                  </dd>

                  @if(count($emails))
                  <dt class="col-sm-3">E-mail</dt>
                  @foreach($emails as $email)<dd class="col-sm-9 d-flex flex-column"><span><a href="mailto:{{$email}}" itemprop="email">{{$email}}</a></span></dd>@endforeach
                  @endif

                  @if(count($urls))
                  <dt class="col-sm-3">WWW</dt>
                  @foreach($urls as $url)<dd class="col-sm-9 d-flex flex-column"><span><a href="{{$url}}"  itemprop="url">{{$url}}</a></span></dd>@endforeach
                  @endif

                  <dt class="col-sm-3">В категориях:</dt>
                  <dd class="col-sm-9">
                  @foreach($organisation->categories as $category)
                     <span class="organisationCategory"><a href="#">{{$category->name}}</a></span>
                  @endforeach
                  </dd>
               </dl>
            </div>

            <div class="col-12 col-sm-6">

            </div>
         </div>
         </article>
      </div>
   </section>
@endsection
