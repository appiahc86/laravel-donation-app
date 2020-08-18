@extends('layouts.app')

@section('content')
<style>
    .stretch{
        width: 30% !important;
    }
</style>

<h1 class="text-center"><b>DONATIONS</b>

</h1>
<hr>



<div class="container">
    {{--  Form Row  --}}
    <div class="row justify-content-center">
        <div class="col col-md-7">
            {!! Form::open(['method'=>'post', 'action'=>'DonationController@store']) !!}
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
    </div>  {{--  ./Form Row  --}}


    {{--  Table Row  --}}
    <div class="row mt-4 justify-content-center">
        <div class="col col-md-8">


            <!-- Trigger/Open The Modal -->
            <button id="myBtn">Open Modal</button>

            <!-- The Modal -->
            <div id="myModal" class="myModal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span id="myClose">&times;</span>
                    <p>
                        @if(Session::has('success'))
                            {{session('success')}}
                        @endif
                    </p>
                </div>

            </div>




            <div class="table-responsive">
                <table class="table table-bordered table-hover table-dark" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                    <tr>
                        <th style="width: 50%;">NAME</th>
                        <th style="width: 20%">AMOUNT</th>
                        @if(Auth::user()->isAdmin())
                        <th></th>
                        <th></th>
                            @endif
                    </tr>
                    </thead>

                    <tbody>

                    @php  $total = 0;   @endphp
                    @if(count($donations) > 0)

                        @foreach($donations as $donation)

                            @php
                                $total += $donation->amount;
                            @endphp
                            <tr>
                                <td style="width: 50% !important;">{{$donation->name}}</td>
                                <td style="width: 20% !important;">{{number_format($donation->amount, 2)}}</td>

                                @if(Auth::user()->isAdmin())
                                <td><a href="{{route('donation-edit', $donation->id)}}" class="btn btn-success btn-sm">Edit</a></td>
{{--                                <td><a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$donation->id}}">Delete</a> </td>--}}
                                <td>
                                    {!! Form::open(["method"=>"delete", "action"=>["DonationController@destroy", $donation->id]]) !!}
                                    {!! Form::submit("Delete",
                                        ["class"=>"btn btn-danger btn-sm",
                                        "onclick"=>"if(!confirm('Are you sure you want to delete?')) return false;"]) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endif


                            </tr>

                        @endforeach

                    @else
                        <h3 class="text-center text-danger">No Record Found</h3>
                    @endif

                    </tbody>

                </table>
            </div>

            <div class="text-danger mt-3 mb-3">

                    <b style="font-size: 2.5em;">Total: GH₵ {{number_format($total,2)}}</b>
                @if(Auth::user()->isAdmin())
                  <span style="float: right;"><a href="{{route('print')}}" class="btn btn-success">Print</a></span>
                @endif
            </div>

        </div>
    </div>
    {{--  ./Table Row  --}}

</div> {{--  ./Container  --}}



@endsection
