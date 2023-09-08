<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Talents Apartment
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
   <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">

  <!-- End Navbar -->
  <section class="min-vh-90 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h3 class="text-white mb-2 mt-5">{{Auth::user()->first_name}} tell us about yourself</h3>
            <p class="text-lead text-white">You are on track to getting the best comfort, all through your academic year</p>
            <br>
          
            @if ($errors->any())
           
             
    <script>
        swal("Error", "All Field Are Required", "error");
    </script>


              
          @endif
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Personal Info</h5>
            </div>

            <div class="card-body">
                  @if (count($errors) > 0)
   <div class = "alert">
      <ul>
         @foreach ($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif

              <form method="POST" action="save_personal_info" id="personal_info">
                @csrf
                <div class="row mb-3">

                    <div class="col-md-12">
                       <label for="">Date of Birth</label>
                       <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" placeholder="date of birth" required>
                       @error('dob')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                   @enderror
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col-md-12">

                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" >
                            <option disabled selected>--Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>

                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-md-12">
                        <input id="first_name" placeholder="street" type="text" class="form-control" name="street" required autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input  placeholder="city" type="text" class="form-control" name="city"  required autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <select class="form-control" name="state" required>
                            <option disabled selected>--Select State--</option>
                            <option value="Abia">Abia</option>
                            <option value="Adamawa">Adamawa</option>
                            <option value="Akwa Ibom">Akwa Ibom</option>
                            <option value="Anambra">Anambra</option>
                            <option value="Bauchi">Bauchi</option>
                            <option value="Bayelsa">Bayelsa</option>
                            <option value="Benue">Benue</option>
                            <option value="Borno">Borno</option>
                            <option value="Cross Rive">Cross River</option>
                            <option value="Delta">Delta</option>
                            <option value="Ebonyi">Ebonyi</option>
                            <option value="Edo">Edo</option>
                            <option value="Ekiti">Ekiti</option>
                            <option value="Enugu">Enugu</option>
                            <option value="FCT">Federal Capital Territory</option>
                            <option value="Gombe">Gombe</option>
                            <option value="Imo">Imo</option>
                            <option value="Jigawa">Jigawa</option>
                            <option value="Kaduna">Kaduna</option>
                            <option value="Kano">Kano</option>
                            <option value="Katsina">Katsina</option>
                            <option value="Kebbi">Kebbi</option>
                            <option value="Kogi">Kogi</option>
                            <option value="Kwara">Kwara</option>
                            <option value="Lagos">Lagos</option>
                            <option value="Nasarawa">Nasarawa</option>
                            <option value="Niger">Niger</option>
                            <option value="Ogun">Ogun</option>
                            <option value="Ondo">Ondo</option>
                            <option value="Osun">Osun</option>
                            <option value="Oyo">Oyo</option>
                            <option value="Plateau">Plateau</option>
                            <option value="Rivers">Rivers</option>
                            <option value="Sokoto">Sokoto</option>
                            <option value="Taraba">Taraba</option>
                            <option value="Yobe">Yobe</option>
                            <option value="Zamfara">Zamfara</option>
                        </select>
                    </div>
                </div>
                <hr>
                <br>
                <h5>Room Info</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <select onchange="loc_room()" class="form-control" name="location" id="location" required>
                            <option disabled selected>--Location--</option>
                            @foreach (DB::table('locations')->get() as $locations)
                            <option value="{{$locations->id}}">{{$locations->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                
                 @foreach (DB::table('locations')->get() as $location)
                     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select.room").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".show-hide").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".show-hide").hide();
            }
        });
    }).change();
});
</script>
                <div class="row mb-3" >
                    <div class="col-md-12">
                        <select class="form-control room" name="room" id="{{$location->id}}" style="display:none"  name="room" onchange="displayDivDemo('hideValuesOnSelect', this)" required>
                             <option disabled selected>--Room Type--</option>
                                        @foreach(DB::table('rooms')->where('location', $location->id)->get() as $room)
                                          <option value="{{$room->id}}">{{$room->name}}</option>
                                        @endforeach
                          </select>
                    </div>
                </div>
        
      
                    @foreach(DB::table('rooms')->where('location', $location->id)->get() as $room)
                     @php
                    $rent_count = DB::table('rents')->where('room_id', $room->id)->count(); // 5
                    $capacity = ($room->capacity * $room->no_of_rooms);
                    $avalaible = ($capacity - $rent_count);
                @endphp
                        <div class="card card-blog card-plain {{$room->id}} show-hide"  style="display:none"">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                    <img src="{{$room->photo /* ?? '/assets/img/no-image.png' */ }}" alt="{{$room->name}}"
                                        class="img-fluid shadow border-radius-lg" style="height:200px; width:100%;">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <p class="text-dark mb-2 text-lg">
                                    <a href="javascript:;">₦
                                        {{$room->price}}</a>
                                    <a href="/room/delete/{{$room->id}}" style="float:right;" type="button"
                                        class="float-right text-danger text-bold mb-0"></a>
                                </p>
                                <a href="javascript:;" class="">
                                    <h5 data-toggle="popover" title="Discription: {{$room->detail}}" data-content="{{$room->detail}}">
                                        {{$room->name}}
                                    </h5>
                                     <span class="mb-2 text-dark font-weight-bold">Capacity:
                                         </span>
                                        <span class="opacity-7">{{$room->capacity}} in a room</span>
                                        <br>
                                        <span class="mb-2 text-dark font-weight-bold">Space Avalaible:
                                        </span>
                                       <span class="opacity-7">{{$avalaible}}</span>

                                </a>
<br>

                                 <p class="mb-2">
                                      <span class="mb-2 mt-1 text-dark font-weight-bold">Details:
                                        </span>
                                    {{$room->detail}}
                                </p>

                               

                            </div>

                        </div>
                   
                   
                    @endforeach
          @endforeach

               

                <!--@foreach (DB::table('locations')->get() as $location)-->

                 
                <!--<div class="row mb-3">-->
                <!--    <div class="col-md-12">-->
                        
                <!--        <select class="form-control room" name="room" id="{{$location->id}}" onchange="showHide(this)" style="display:none" required>-->
                <!--                <option disabled selected>--Room Type--</option>-->
                <!--                @foreach(DB::table('rooms')->where('location', $location->id)->get() as $room)-->
                <!--                  <option value="{{$room->id}}">{{$room->name}}</option>-->
                <!--                @endforeach-->
                <!--        </select>-->
                <!--    </div>-->
                <!--</div>-->
                <!--@endforeach-->
                
                <!-- @foreach(DB::table('rooms')->get() as $room)-->
                <!--    <div class="show-hide"  style="display:none" id="{{$room->id}}" >-->
                <!--        <a class="d-block shadow-xl border-radius-xl">-->
                <!--        <img src="{{$room->photo}}" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">-->
                <!--        </a>-->
                <!--        <p>Room Name: {{$room->name}}</p>-->
                <!--        <p>Room Price: N{{$room->price}}</p>-->
                <!--        <p>Capacity: {{$room->capacity}} in a room</p>-->
                <!--        <p>Detail: {{$room->detail}}</p>-->
                <!--    </div>-->
                <!--    @endforeach-->
                <script>
                    function loc_room(){
                        let location = document.getElementById("location").value;
                        allrooms =document.getElementsByClassName("room");
                        console.log(location);
                        //console.log(allrooms[1].style.display);
                        for(let i = 0; i < allrooms.length; i++){
                            if(allrooms[i].id == location ){
                                allrooms[i].style.display = "block";
                            }else{
                                allrooms[i].style.display = "none";
                            }
                        }
                    }
                    
                    

                </script>


      

                <hr>
                <br>
                <h5>school Info</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input  placeholder="school" type="text" class="form-control" name="school" required autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <select class="form-control" required name="level" id="" >
                            <option disabled selected>--Level--</option>
                                <option value="pre_degree">Pre Degree</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                                <option value="PostGraduate">Post Graduate</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input  placeholder="course" type="text" class="form-control" name="course" required autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input  placeholder="department" type="text" class="form-control" name="department" required autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input  placeholder="faculty" type="text" class="form-control" name="faculty" required autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input  placeholder="matric" type="text" class="form-control" name="matric" required autofocus>
                    </div>
                </div>



                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-info">
                            Apply
                        </button>
                    </div>
                </div>
            </form>
            <small for="">Already have an account? </small><a href="/login">click here to login</a>


            </div>
          </div>
        </div>


    </div>
  </section>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">

      </div>
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Talents Apartment
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
