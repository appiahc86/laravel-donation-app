<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DONATIONS</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    </head>
    <body>
    <style>
        .stretch{
            width: 30% !important;
        }
    </style>

         <h1 class="text-center mt-5 mb-3"><b>DONATIONS</b>

           @if(Session::has('success'))
                 <span id="successMessage" style="font-size: 30px !important;" class="text-success"> {{session(('success'))}}</span>
             @endif

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
                {!! Form::number('amount', null, ['class'=>'form-control', 'step'=>0.1, 'autocomplete'=>'off', 'min'=>0, 'required']) !!}

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
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-dark" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                       <tr>
                           <th style="width: 50%;">NAME</th>
                           <th style="width: 20%">AMOUNT</th>
{{--                           <th colspan="2" class="text-center">ACTION</th>--}}
                           <th></th>
                           <th></th>
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
                               <td><a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit{{$donation->id}}">Edit</a></td>
                               <td><a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$donation->id}}">Delete</a> </td>

                               <!-- Delete Modal  -->

                               <div class="modal fade" id="delete{{$donation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title text-danger" id="exampleModalLabel"><b>Delete This Record?</b></h5>
                                               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <span"><b>Name: {{$donation->name}} &nbsp; &nbsp; Amount: {{number_format($donation->amount, 2)}}</b></span><br>
                                               <span>Are You Sure You Want To Delete This Record? There Is No Undo!!</span>
                                           </div>
                                           <div class="modal-footer">
                                               {!! Form::open(['method'=>'delete', 'action'=>['DonationController@destroy', $donation->id]]) !!}
                                               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                               {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                               {!! Form::close() !!}
                                           </div>
                                       </div>
                                   </div>
                               </div>


                               <!-- Edit Modals  -->

                               <div class="modal fade" id="edit{{$donation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="exampleModalLabel">Want To Modify?</h5>
                                               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               {!! Form::model($donation,['method'=>'patch', 'action'=>['DonationController@update', $donation->id]]) !!}

                                               <div class="form-group">
                                                   {!! Form::label('name', 'Name') !!}
                                                   {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Name Of Donor', 'autocomplete'=>'off', 'minlength'=>'3', 'required']) !!}
                                               </div>

                                               <div class="form-group">
                                                   {!! Form::label('amount', 'Amount') !!}
                                                   {!! Form::number('amount', null, ['class'=>'form-control', 'step'=>0.1, 'autocomplete'=>'off', 'min'=>0, 'required']) !!}
                                               </div>

                                           </div>
                                           <div class="modal-footer">
                                               {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                                               {!! Form::close() !!}
                                           </div>

                                       </div>
                                   </div>
                               </div>





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
                <span style="float: right;"><a href="{{route('print')}}" class="btn btn-success">Print</a></span>
            </div>

        </div>
    </div>
    {{--  ./Table Row  --}}

</div> {{--  ./Container  --}}

    <script src="{{ asset('js/app.js')}}"></script>
{{--    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>--}}
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('demo/datatables-demo.js') }}"></script>


    <script>
        $(function () {
             setTimeout(function () {
                 $('#successMessage').fadeOut(3000)
             },3000);
        })
    </script>
    </body>

</html>














