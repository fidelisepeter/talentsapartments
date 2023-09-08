@extends('pages.home-page.layout')

@section('page-title', 'About')
@section('content')
    

			<!-- ============================ Page Title Start================================== -->
			<div class="page-title" style="background:#f4f4f4 url({{ asset('home-page-assets/img/girl1.jpeg') }});" data-overlay="5">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="_page_tetio">
							<h1 class="text-light mb-0">About </h1>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Our Story Start ================================== -->
			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row align-items-center">
						
						<div class="col-lg-6 col-md-6">
							<div class="story-wrap explore-content">
								
								<h3>Talents Apartments</h3>
								
								<p class="mt-4">Talents Apartments offers premium, safe student accommodation with a unique hospitality approach to service, for total peace of mind. Our two locations are conveniently located inside and outside of the University of Ibadan depending on your needs.

                                    Each Apartment consists between 4 to 6 fully furnished and self-contained apartments, each with a private bathroom and kitchen. Private rooms combined with communal studying, social and entertainment spaces, ensuring students enjoy total privacy within a vibrant student environment.
                                    
                                    </p>
								<p class="mb-3">A fully functional kitchen equipped with lockers, and a table and chairs to enjoy meals. Bedrooms are furnished with a single bed mattress, storage built-in cupboard, desk, chair and others. Also each has its own private shower, a toilet, and a basin.
                                    
                                    Comfortable communal areas offer laundry facilities, Wi-Fi, spaces to share ideas and experiences with other students, and direct access to the building. Resident Managers ensure all necessities are taken care of so you can focus on your studies.</p>
								<a href="/rooms2" class="btn theme-bg btn-rounded">Find a Room</a>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6">
							<img src="{{ asset('home-page-assets/img/girl2.jpg') }}" class="img-fluid rounded" alt="" />
						</div>
						
					</div>
					<!-- /row -->					
					
				</div>
						
			</section>

@endsection


@section('style')
    
@endsection