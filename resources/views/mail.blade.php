<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$subject}}</title>
</head>

<body style="background-color: rgb(234, 235, 250); padding: 12px;">
    <div class="class"
        style="max-width: 100%;
flex: 0 0 100%; background-color: #fff;  border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.15) 0px 0.5rem 1rem !important;">
        <div class="logo" style="padding: 20px; text-align: center;">
            <a href="https://tenantapartment.com">
                <img src="{{url('/logo.jpg')}}" style="width: 200px;" alt="Tenant Apartment">
            </a>
        </div>
        <div class="header" style="font-family: Arial, Helvetica, sans-serif;
        line-height: 1.6;
font-weight: 700;
color: rgb(255, 255, 255);
font-size: 20px; background: linear-gradient(310deg, #17C1E8  0%, #abe3f0  100%); padding: 15px 20px;">{{$subject}}</div>
        <div class="body" style="background: rgb(255, 255, 255); padding: 15px;">
            {{-- <h5>Hello {{$user }}</h5> --}}
            {!! html_entity_decode($message) !!}
        </div>
        <div class="footer" style="background-color: rgb(255, 255, 255);
        line-height: 1.6;
-webkit-font-smoothing: antialiased;
font-size: 16px;
color: rgb(111, 139, 164);
font-weight: 400;text-align: center;
border-top: 1px solid #232226;padding: 10px 1px;">
            <a href="" style="font-family: Exo, sans-serif;
            font-weight: 700;
            color: #17C1E8;">Talent Apartment</a> - Made with Love <br> (c) {{ date('Y')}}

        </div>

    </div>
</body>

</html>
