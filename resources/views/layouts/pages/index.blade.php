@extends('layouts.master')
@section('content')
  <section id="content">
    <div class="container">
      <div class=row>
        
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary">
            <img class="card-img-top" src="/images/taxi.jpg" alt="Такси в Урюпинске">
            <div class="card-header text-center">Службы такси</div>
            <div class="card-body">
              @foreach($taxiServices as $taxiService)
              <div class="row no-gutters">
                <div class="col col-auto pr-3"><a href="{{route('taxi.show',[$taxiService->slug])}}" class="card-link text-nowrap">{{$taxiService->name}}</a></div>
                <div class="col text-right text-truncate">
                  @php
                    $phone = $taxiService->phones[0];
                    $phoneNationalFormat = phone($taxiService->phones[0],'RU',\libphonenumber\PhoneNumberFormat::NATIONAL);
                    $phoneCityNumber = substr($phoneNationalFormat,strLen($phoneNationalFormat)-7,7);
                  @endphp
                  <span itemprop="telephone"><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}">{{$phoneCityNumber}}</a></span>
                </div>
              </div>
              @endforeach
            </div>
            <div class="card-footer"><a href="/transport/taxi" class="card-link">Все службы такси в городе</a></div>
          </div>
        </div>
    
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-secondary">
            <img class="card-img-top" src="/images/minibus.jpg" alt="Общественный транспорт Урюпинска">
            <div class="card-header text-center">Маршрутки</div>
            <div class="card-body"></div>
            <div class="card-footer"><a href="#" class="card-link">Весь общественный транспорт</a></div>
          </div>
        </div>
      
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card">
            <img class="card-img-top" src="/images/phonebook.jpg" alt="Общественный транспорт Урюпинска">
            <div class="card-header text-center">Справочник организаций</div>
            <div class="card-body">
              @foreach($organisations as $org)
              <div class="row no-gutters">
                <div class="col text-truncate"><a href="#" class="card-link">{{$org->name}}</a></div>
                <div class="col col-auto text-right text-truncate">
                  @if(count($org->contacts))
                  @php
                    $phone = $org->contacts[0]->contact;
                    $phoneNationalFormat = phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL);
                    $phoneCityNumber = substr($phoneNationalFormat,strLen($phoneNationalFormat)-7,7);
                  @endphp
                  <span itemprop="telephone"><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}">{{$phoneCityNumber}}</a></span>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
            <div class="card-footer"><a href="#" class="card-link">Полный справочник организаций</a></div>
          </div>
        </div>
    
      </div>
    </div>
  </section>
@endsection