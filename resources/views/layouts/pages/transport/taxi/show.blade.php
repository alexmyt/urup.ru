@extends('layouts.master')
@section('content')
<section id="content">
   <div class="container" itemscope itemtype="http://schema.org/Organization">
      @include('layouts.partials._header',['headerText'=>$taxiService->name,'headerSub'=>'Служба такси'])
      <article>
         <div class="row">
            <div class="col">
               <h4>Тарифы</h4>
               <table class="table table-sm">
                  <tbody>
                     <tr>
                        <th scope="row">Цена за посадку:</th>
                        <td>{{$taxiService->priceGettingDay}} (день)<br>{{$taxiService->priceGettingNight}} (ночь)</td>
                     </tr>
                     <tr>
                        <th scope="row">Цена за км:</th>
                        <td>{{$taxiService->pricePerKmIncityDay}} (день)<br>{{$taxiService->pricePerKmIncityNight}} (ночь)</td>
                     </tr>
                     <tr>
                        <th scope="row">Цена за км (за городом):</th>
                        <td>{{$taxiService->pricePerKmOutcityDay}} (день)<br>{{$taxiService->pricePerKmOutcityNight}} (ночь)</td>
                     </tr>
                  </tbody>
               </table>
            </div>
               
            <div class="col">
               <h4>Телефоны</h4>
               @foreach($taxiService->phones as $phone)
                 <span itemprop="telephone" class="text-nowrap"><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}">{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL)}}</a></span>
                 <br>
               @endforeach
            </div>

            <div class="col-12 col-lg-4">
               <h4>Примерная стоимость поездки</h4>
               <table class="table table-sm">
                  <tbody>
                     <tr>
                        <th scope="row">Новониколаевский:</th>
                        <td></td>
                     </tr>
                     <tr>
                        <th scope="row">Поворино:</th>
                        <td></td>
                     </tr>
                     <tr>
                        <th scope="row">Борисоглебск:</th>
                        <td></td>
                     </tr>
                  </tbody>
               </table>
            </div>

         </div>

         <p>{{$taxiService->description}}</p>

      </article>
   </div>
</section>
@endsection