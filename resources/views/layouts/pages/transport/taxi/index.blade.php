@extends('layouts.master')
@section('content')
  <section id="content"><div class="container">
    @include('layouts.partials._header',['headerText'=>'Все службы такси Урюпинска'])
    
    <table class="table table-striped table-responsive-sm">
      <thead class="thead-light table-sm text-center">
        <tr>
          <th scope="col"></th>
          <th scope="col">Телефоны</th>
          <th scope="col">Посадка</th>
          <th scope="col">Цена км</th>
        </tr>
      </thead>

      <tbody>
        @foreach($allTaxiServices as $taxiService)
        <tr>
          <th scope="row" class="w-50"><a href="{{route('taxi.show',[$taxiService->slug])}}">{{$taxiService->name}}</a></th>
            <td>
              @foreach($taxiService->phones as $phone)
                <span itemprop="telephone" class="text-nowrap"><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}">{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL)}}</a></span>
                <br>
              @endforeach
            </td>
            <td class="text-center">{{$taxiService->priceGettingDay}}</td>
            <td class="text-center">{{$taxiService->pricePerKmIncityDay}}</td>
        </tr>
        @endforeach
      </tbody>

    </table>
{{--
    <div class="row">
    @foreach($allTaxiServices as $taxiService)
      <div class="col-md-6 col-sm-12">
        <div class="card taxi-card" itemscope itemtype="http://schema.org/LocalBusiness">
          <h3 itemprop="name"><i class="fa fa-taxi a-bg-green"></i> {{$taxiService->name}}</h3>
            <p class="description taxi-descriprion"><a href="{{route('taxi.show',[$taxiService->slug])}}">{{$taxiService->description}}</a></p>
            <p class="phone taxi-phones">
              @foreach($taxiService->phones as $phone)
                <span itemprop="telephone" class="text-nowrap"><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}">{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL)}}</a></span>
              @endforeach
            </p>
        </div>
      </div>
    @endforeach
    </div>
  </div></section>  
--}}
@endsection
