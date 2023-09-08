@extends('pages.home-page.layout')

@section('page-title', 'Contacts')
@section('content')
    


<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url({{ asset('home-page-assets/img/guy.jpeg') }});" data-overlay="5">
    <div class="ht-80"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="_page_tetio">

                    <h1 class="text-light mb-0">Contact </h1>
                    <p class="px-5">Fill up the form below and our Team will get back to you within 24 hours.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ht-120"></div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section class="pt-0">
    <div class="container">
        <div class="row align-items-center pretio_top">
            <div class="col-lg-5 col-md-6">
                <div class="col">
                    <div class="contact-box">
                        <div class="cntainer pt-3">
                            <i class="bi theme-cl bi-telephone"></i>
                            <h4>Phone</h4>
                            <span> <a href="tel:2348069578636">(+234) 806 9578 636</a></span><br />
                            <span><a href="tel:2348105446372">(+234) 810 5446 372</a></span>
                        </div>
                        <div class="container pt-3">
                            <i class="bi theme-cl bi-envelope"></i>
                            <h4>Email</h4>
                            <p><a href="mailto:reservations@talentsapartments.com">reservations@talentsapartments.com</a></p>
                        </div>

                        <div class="container pt-3 ">
                            <i class="bi theme-cl bi-house"></i>
                            <h4>Address</h4>
                            <p>No 6 NASU street , Agbowo Ibadan Oyo state</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="property_block_wrap">

                    <div class="property_block_wrap_header">
                        <h4 class="property_block_title">Fillup The Form</h4>
                    </div>

                    <div class="block-body">
                        <form id="contact-form" action="/send_contact_mail" method="post">
                            @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control simple" required>
                        </div>


                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control simple" required>
                        </div>



                        <div class="form-group">
                            <label>Your Message</label>
                            <textarea class="form-control simple" name="message" required></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-theme" type="submit">Send Message</button>
                        </div>
                        </form>
                    </div>



                </div>
            </div>

        </div>

        <!-- row Start -->
        <div class="row">


            <div class="col-lg-6 col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15824.972736703918!2d3.9046381662067264!3d7.438322241370014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1039edc3399f5dc5%3A0xf56b66a9d0fec498!2sTalents%20Hostel!5e0!3m2!1sen!2sng!4v1661817591665!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-lg-6 col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.279677038265!2d3.8917660406952206!3d7.43427309695488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1039f2ba567c723f%3A0x227eef90b62a6ee!2sCVMV%2BMCR%2C%20200132%2C%20Ibadan%2C%20Oyo%2C%20Nigeria!5e0!3m2!1sen!2sus!4v1672172518902!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
        <!-- /row -->
    </div>
</section>
<!-- ============================ Agency List End ================================== -->
@endsection


@section('style')
    
@endsection