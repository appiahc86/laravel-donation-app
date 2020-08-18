@extends('layouts.app')

@section('content')
    <style>
        .stretch{
            width: 30% !important;
        }
    </style>

    <h1 class="text-center mt-5 mb-3"><b>Edit Record</b></h1>
    <hr>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-7">


                {!! Form::model($donation,['method'=>'PATCH', 'action'=>['DonationController@update', $donation->id]]) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <b>Name</b>
                        </div>
                    </div>
                    {!! Form::text('name', null, ['class'=>'form-control stretch', 'placeholder'=>'Name Of Donor', 'autocomplete'=>'off', 'minlength'=>'3', 'required']) !!}

                    <div class="input-group-prepend">
                        <div class="input-group-text"><b>Amount (GH₵)</b></div>
                    </div>
                    {!! Form::number('amount', null, ['class'=>'form-control', 'step'=>0.00001, 'autocomplete'=>'off', 'min'=>1, 'required']) !!}

                    <div class="input-group-append">
                        {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-sm']) !!}
                    </div>
                </div>


                {!! Form::close() !!}

            </div>
          </div>
        </div>


@endsection
