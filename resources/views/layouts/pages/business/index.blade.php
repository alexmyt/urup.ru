@inject('categories','App\Category')
@inject('organisations','App\Organisation')
@extends('layouts.master')
@section('content')
  <section id="content">
    <div class="container">
      @include('layouts.partials._header',['headerText'=>'Справочник организаций Урюпинска'])

      <div class="row">
        <div class="col-12 col-sm-9">
          <ui-autocomplete
              name="favourite_month"
              label="Введите название организации"
              floating-label
              icon="search"
              icon-position="left"
          ></ui-autocomplete>

        </div>
        <div class="col col-sm-3">
          <ui-button
              icon="add"
              size="large"
          >Добавить организацию
          </ui-button>
            {{--<button class="btn btn-primary btn-lg btn-block" type="button" aria-label="Добавить организацию"><i class="fa fa-plus-circle"></i> <span class="d-none d-xl-inline-block">Добавить организацию</span></button>--}}
        </div>
      </div>

      <div class="row">
        @foreach($cards as $card)
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-secondary">
              <div class="card-header text-center">
                <p class="h5 my-0">{{$card['name']}}</p>
              </div>
              <div class="card-body">
                @foreach($organisations->inCategory($card['id'])->with(['contacts'=>function($query){$query->where('contact_type','phone');}])->take(3)->get() as $organisation)
                  <div class="row no-gutters">
                    <div class="col text-truncate pr-3"><a href="{{route('organisation.show',[$organisation->slug])}}" class="card-link">{{$organisation->name}}</a></div>
                    @php
                      $phone = $organisation->contacts[0]->contact;;
                      $phoneNationalFormat = phone($phone,'RU',\libphonenumber\PhoneNumberFormat::NATIONAL);
                      $phoneCityNumber = substr($phoneNationalFormat,strLen($phoneNationalFormat)-7,7);
                    @endphp
                    <div class="col text-right col-auto"><span itemprop="telephone"><a href="{{phone($phone,'RU',\libphonenumber\PhoneNumberFormat::RFC3966)}}">{{$phoneCityNumber}}</a></span></div>
                  </div>
                @endforeach
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        @endforeach

        <div class="col-12">

         <ui-fab color="primary" icon="add" size="normal"></ui-fab>
       </div>
      </div>

      <div class="d-none d-sm-block">
        <h3>Категории</h3>
        <ul>
        @foreach($categories->withDepth()->with('organisations')->get() as $category)
          @if($category->depth > 0 && $category->organisations->count() > 0)
            <li>{{$category->name}} ({{$category->organisations->count()}})</li>
          @endif
        @endforeach
        </ul>
      </div>

    </div> {{--container--}}
  </section>

@endsection