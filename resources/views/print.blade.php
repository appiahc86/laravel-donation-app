<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donations</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>

<h2 class="text-center mt-3"><b>REPORT</b></h2>
<div class="container">


    <table class="table">
        <thead>
        <tr>
            <th>NAME</th>
            <th>AMOUNT</th>
        </tr>
        </thead>

        @php $total = 0; @endphp
        <tbody>
        @foreach($donations as $donation)

            @php $total += $donation->amount; @endphp
            <tr>
                <td>{{ $donation->name }}</td>
                <td>{{ number_format($donation->amount, 2) }}</td>
            </tr>

        @endforeach
        </tbody>

    </table>

    <div style="font-size: 2em;"><b>Total: GH₵ {{number_format($total, 2)}}</b></div>

</div>

<script src="{{ asset('js/app.js')}}"></script>

<script>
    $(function () {
         window.print();
      setTimeout(function () {
          window.location.href = '/home';
      },10)
        // window.location.href = '/';


    })
</script>

</body>
</html>
