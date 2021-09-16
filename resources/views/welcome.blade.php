@extends('layouts.app')

@section('content')
<!-- Contact us form page -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact Us') }}</div>

                <div class="card-body">
                <!-- View JS template and pass all genders -->
                 <contact-component :genders="{{json_encode($genders)}}"> </contact-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


