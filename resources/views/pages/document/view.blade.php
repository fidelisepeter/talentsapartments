@extends('layouts.main')
@if (Auth::user()->role == 'student')
    <script>
        window.location.href = "{{ url('/profile') }}";
    </script>
@endif
@section('style')
@endsection
@section('page-title', 'Edit '.$document->title)
@section('content')


    @php
        if ($errors) {
            $outPut = '<ul class="list-group" style="justify-content: center; padding: 1em 1.6em 0.3em; text-align: left !important;">';
            foreach ($errors->all() as $error) {
                $outPut .= '<li class="list-group-item border-0 ps-0 pt-0 text-sm"><span class="text-danger">*</span> ' . $error . '</li>';
            }
            $outPut .= '<ul>';
        }
        
    @endphp
    {{-- @dd($errors->all()) --}}
    @if ($errors->all())
        <script>
            const requiredButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger'
                },
                buttonsStyling: false
            })
            requiredButtons.fire({
                title: 'Error',
                html: '{!! html_entity_decode($outPut) !!}',
                showCloseButton: true,
            })
        </script>
    @endif
    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <div class="row mt-3" id="f-row">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Document Settings</h6>
                </div>
                <div class="card-body p-3">
                    <form action="/document/{{ $document->id ?? '' }}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <label class="">Pdf file</label>

                        <input type="file" class="form-control mb-3" name="file" id="myPdf"> --}}
                        <label class="">File title</label>
                        <input class="form-control" type="text" name="title" onfocus="focused(this)"
                            onfocusout="defocused(this)" id="" required value="{{ $document->title ?? '' }}">
                        <label class="">Type of file</label>
                        <select class="form-control" name="type" id="type" required>
                           
                            <option value="site_document" @if ($document->type == 'site_document') selected @endif>
                                Site Document
                            </option>
                                <option value="agreement_form" @if ($document->type == 'agreement_form') selected @endif>
                                    Agreement Form
                                </option>
                               
                                <option value="others" @if ($document->type == 'others') selected @endif>
                                    Others
                                </option>
                           


                        </select>
                       
                        <h6 class="mt-4 text-uppercase text-body text-xs font-weight-bolder">Signatures</h6>

                        <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="has-signature"
                                        name="has_signature" @if ($document->has_signature == true) checked @endif>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                        for="has-signature">has signature field</label>
                                </div>
                                <div class="@if ($document->has_signature == false) d-none @endif">
                                    <label>config <span class="text-xxs">in json format</span></label>
                                    <textarea id="signature_config" name="signature_config" class="multisteps-form__textarea text-xxs form-control"
                                        style="line-height: 1.4;" rows="5" placeholder="eg. [{page:1,x:30,y:200},{page:7,x:167,y:200}]."
                                        @if ($document->has_signature == false) disabled @endif>{{ $document->signature_config ?? '' }}</textarea>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="has-stamp" name="has_stamp"
                                        @if ($document->has_stamp == true) checked @endif>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                        for="has-stamp">has stamp field</label>
                                </div>
                                <div class="@if ($document->has_stamp == false) d-none @endif">
                                    <label>config <span class="text-xxs">in json format</span></label>
                                    <textarea id="stamp_config" name="stamp_config" class="multisteps-form__textarea text-xxs form-control"
                                        style="line-height: 1.4;" rows="5" placeholder="eg. [{page:1,x:30,y:200},{page:7,x:167,y:200}]."
                                        @if ($document->has_stamp == false) disabled @endif>{{ $document->stamp_config ?? '' }}</textarea>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="has-user-name"
                                        name="has_user_name" @if ($document->has_user_name == true) checked @endif>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                        for="has-user-name">has user name field</label>
                                </div>
                                <div class="@if ($document->has_user_name == false) d-none @endif">
                                    <label>config <span class="text-xxs">in json format</span></label>
                                    <textarea id="user_name_config" name="user_name_config" class="multisteps-form__textarea text-xxs form-control"
                                        style="line-height: 1.4;" rows="5" placeholder="eg. [{page:1,x:30,y:200},{page:7,x:167,y:200}]."
                                        @if ($document->has_user_name == false) disabled @endif>{{ $document->user_name_config ?? '' }}
                                    </textarea>
                                </div>
                            </li>

                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="has-lawyer-name"
                                        name="has_lawyer_name" @if ($document->has_lawyer_name == true) checked @endif>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                        for="has-lawyer-name">has lawyer name field</label>
                                </div>
                                <div class="@if ($document->has_lawyer_name == false) d-none @endif">
                                    <label>config <span class="text-xxs">in json format</span></label>
                                    <textarea id="lawyer_name_config" name="lawyer_name_config" class="multisteps-form__textarea text-xxs form-control"
                                        style="line-height: 1.4;" rows="5" placeholder="eg. [{page:1,x:30,y:200},{page:7,x:167,y:200}]."
                                        @if ($document->has_lawyer_name == false) disabled @endif>{{ $document->lawyer_name_config ?? '' }}</textarea>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="form-check form-switch ps-0">
                                    <input class="form-check-input ms-auto" type="checkbox" id="show-sign-date"
                                        name="show_sign_date" @if ($document->show_sign_date == true) checked @endif>
                                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                        for="show-sign-date">Show Signed Date</label>
                                </div>
                                <div class=" @if ($document->show_sign_date == false) d-none @endif">
                                    <label>config <span class="text-xxs">in json format</span></label>
                                    <textarea id="signed_date_config" name="signed_date_config" class="multisteps-form__textarea text-xxs form-control"
                                        style="line-height: 1.4;" rows="5" placeholder="eg. [{page:1,x:30,y:200},{page:7,x:167,y:200}]."
                                        @if ($document->show_sign_date == false) disabled @endif>{{ $document->signed_date_config ?? '' }}</textarea>
                                </div>
                            </li>

                        </ul>
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Option</h6>
                        <ul class="list-group">
                            <label class="mt-4 form-label">Staffs to sign</label>
                            <select class="form-control" name="lawyers_assigned[]" id="assign_to_lawyer" multiple>
                                {{-- <option value="Choice 1" selected>Choice 1</option> --}}
                                @foreach ($lawyers as $lawyer)
                                {{-- @dd($document->lawyers_assigned); --}}
                                @php
                                  $document_lawyers_assigned = $document->lawyers_assigned != null ? json_decode($document->lawyers_assigned) : [];
                                @endphp
                                    <option value="{{ $lawyer->id }}"
                                        @if (in_array($lawyer->id, $document_lawyers_assigned ?? [])) selected @endif>
                                        {{ $lawyer->name() }}
                                    </option>
                                @endforeach


                            </select>
                            <label>File Description <span class="text-xxs"></span></label>
                            <textarea id="description" name="description" class="multisteps-form__textarea text-xxs form-control"
                                style="line-height: 1.4;" rows="5" placeholder="eg. [{page:1,x:30,y:200},{page:7,x:167,y:200}].">{{ $document->description ?? '' }}</textarea>
                        </ul>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="/documents" class="btn btn-light m-0">Cancel</a>
                            <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2">Update
                                Document</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-8 mt-md-0 mt-4">
            <div class="card bg-gradient-dark">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <h5 class="mb-0" style="color: white;">PREVIEW</h5>

                        </div>
                        <div class="col-lg-6 col-md-6 col-12 my-auto ms-auto">
                            <div class="d-flex align-items-center">
                                {{-- <i class="ni ni-headphones text-lg ms-auto" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Headphones connected"></i> --}}
                                <span class="text-xs ms-auto" > Coordinate </span>
                                <h4 class="mb-1 ms-4" id="coords" style="color: white;"></h4>
                                </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="hide-preview-text">
                                <p class="description text-xs m-0" style="color: white;">If you want to update a given position using the preview panel make
                                    sure you have deleted it from the config setting. It is adviced to clear all config if you made
                                    a mistake or want to update it</p>
                                <p class="discription text-xs m-0" style="color: white;"><span class="text-danger">Note</span> The preview panel only
                                    make your work much easier, but it is not promising to be accurate (it's base on your DPI)</p>
        
        
                            </div>
        
                        </div>
                    </div>
                    <hr class="horizontal light">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="d-flex align-items-center">
                                <button class="btn  btn-icon-only btn-rounded btn-outline-white mb-0 ms-auto"
                                    id="prev-page">
                                    <i class="ni ni-button-play top-0 rotate-180" aria-hidden="true"></i>
                                </button>
                                <input name="page_number" type="number" id="page_number"
                                    class="text-white border border-rounded form-control bg-transparent border-1 ms-2"
                                    value="1">

                                <button class="btn  btn-icon-only btn-rounded btn-outline-white mb-0 ms-2 me-auto"
                                    id="next-page">
                                    <i class="ni ni-button-play top-0" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="d-flex align-items-center position-relative">
                                <input class="form-control" type="hidden" value="0" onfocus="focused(this)"
                                    onfocusout="defocused(this)" id="get-y">
                                    <input class="form-control" type="hidden" value="0" onfocus="focused(this)"
                                    onfocusout="defocused(this)" id="get-x">
                                <h5 class="ms-1" style="color: rgb(146, 145, 145);"><span id="x-coord">0</span><small
                                        class="align-top text-xs">X</small></h5>
                                <h5 class="ms-1" style="color: rgb(146, 145, 145);"><span id="y-coord">0</span><small
                                        class="align-top text-xs">Y</small></h5>
                                <hr class="vertical light mt-0" style="color: rgba(255, 255, 255, 0.849);">
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="d-flex align-items-center position-relative">
                                <div class="input-group ">
                                    
                                    <select
                                        style="
                                    /* color: rgb(255, 255, 255); */
                                    border-top-right-radius: 0px!important;
                                    border-bottom-right-radius: 0px!important;
                                    "
                                        class="me-auto form-control bg-transparent border-1" id="append-button"
                                        name="append">
                                        <option>Set For:</option>
                                        <option value="signature_config" onclick="notify(this)" data-type="success"
                                            data-content="Signature Position Added" data-title="Added"
                                            data-icon="ni ni-bell-55">Signature</option>
                                        <option value="stamp_config">Stamp</option>
                                        <option value="user_name_config">User name</option>
                                        <option value="lawyer_name_config">Lawyer name</option>
                                        <option value="signed_date_config">Signed Date</option>

                                    </select>


                                    <button
                                        style="
                                    border-top-left-radius: 0px!important;
                                    border-bottom-left-radius: 0px!important;
                                    "
                                        class="btn btn-rounded bg-white" id="full-screen-button" type="button"
                                        name="button">Use
                                        Full
                                        Screen</button>
                                    <button
                                        style="
                                border-top-left-radius: 0px!important;
                                border-bottom-left-radius: 0px!important;
                                "
                                        class="btn btn-rounded btn-outline-white d-none" id="remove-full-screen-button"
                                        type="button" name="button">Use Normal
                                        Screen</button>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="card-body px-0 py-0" style="background: #ddd;">
                    <div id="work-space" style="max-width:446.25px; min-height:631.75px;" class="mt-1 position-relative">
                        <span id="cursor" class="position-absolute" style="border-style: dotted dotted solid solid;border-width: 2px 0px 0px 2px;height: 15px;border-color: linear-gradient(310deg, #141727 0%, #3A416F 100%);width: 40px;"></span>
                        <canvas  id="pdfViewer" class="w-100 h-100">
                        </canvas>
                    </div>
                </div>
                <div class="card-footer">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="jquery.min.js"></script>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pdf.js') }}"></script>

    <script type="text/javascript">
        // alert(document.getElementById("pdfViewer").offsetHeight)

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('/assets/js/pdf.worker.js') }}";

        $("#myPdf").on("change", function (e) {

        });
        
        
            preview('{{ asset($document->document_path) }}', 1, 'page_number');
        

        $("#page_number").on("change", function(e) {
            // alert(JSON.stringify(this.value))
            var page = this.value
            preview('{{ asset($document->document_path) }}', Number(page), 'page_number');
        });

        $("#next-page").on("click", function(e) {
            // alert(JSON.stringify(this.value))
            var page = $("#page_number").val()
            var min = $("#page_number").attr('min')
            var max = $("#page_number").attr('max')
            if(max > page){
                page++;
                
                preview('{{ asset($document->document_path) }}', Number(page), 'page_number');
                $("#page_number").val(page)
            }
            
            
        });

        $("#prev-page").on("click", function(e) {
            // alert(JSON.stringify(this.value))
            var page = $("#page_number").val()
            var min = $("#page_number").attr('min')
            var max = $("#page_number").attr('max')
            if(page !== min){
                page = page-1;
                
                preview('{{ asset($document->document_path) }}', Number(page), 'page_number');
                $("#page_number").val(page)
            }
            
            
        });


        // $(document).load(function(e) {
        //     preview('{{ asset($document->document_path) }}', 1, 'page_number');
        // });

       

        

        function preview(url, pageNumber = 1, incre_id) {
            // var file = i.files[0]
            // var input = document.getElementById(id);

            // alert(JSON.stringify(i.files[0]))
            // var file = input.files[0];
           
                
                    var pdfData = new Uint8Array(this.result);

                    // Using DocumentInitParameters object to load binary data.
                    var loadingTask = pdfjsLib.getDocument(url);
                    loadingTask.promise.then(function(pdf) {

                        var getNumber = document.getElementById(incre_id);

                        console.log('PDF loaded');
                        console.log('PDF loaded' + JSON.stringify(pdf.numPages));



                        $(getNumber).attr('min', 1);
                        $(getNumber).attr('max', pdf.numPages);


                        // Fetch the first page
                        // var pageNumber = 1;
                        pdf.getPage(pageNumber).then(function(page) {
                            console.log('Page loaded');

                            var scale = 1.5;
                            var viewport = page.getViewport({
                                scale: scale
                            });

                            // Prepare canvas using PDF page dimensions
                            var canvas = $("#pdfViewer")[0];
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            // Render PDF page into canvas context
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            var renderTask = page.render(renderContext);
                            renderTask.promise.then(function() {
                                console.log('Page rendered');
                            });
                        });
                    }, function(reason) {
                        // PDF loading error
                        console.error(reason);
                    });
                    

        }
    </script>
    <script type="text/javascript">
        // alert(document.getElementById("pdfViewer").offsetHeight)
        //842/4 = 210.5, 210.5*3 = 631.75
        //595/4 = 148.75, 148.75*3 = 446.25
        //X/4 =*3
        //Reverse
        //631.75/3 = 210.5, 210.5*4 = 842
        //446.25/3 = 148.75, 148.75*4 =595
        //X/3 =*4
        /*
         Here add the ID of the HTML elements for which to show the mouse coords
         Within quotes, separated by comma.
         E.g.:   ['imgid', 'divid'];
        */
        $("input[id='has-signature']").change(function() {
            var cnt = $("input[id='has-signature']:checked").length;

            if (cnt !== 0) {
                // $(this).prop("checked", "");

                $('#signature_config').attr({
                    "disabled": false,
                }).parent().removeClass('d-none');

            } else {
                $('#signature_config').attr({
                    "disabled": true,
                }).parent().addClass('d-none');
            }
        });
        $("input[id='has-stamp']").change(function() {
            var cnt = $("input[id='has-stamp']:checked").length;

            if (cnt !== 0) {
                // $(this).prop("checked", "");

                $('#stamp_config').attr({
                    "disabled": false,
                }).parent().removeClass('d-none');

            } else {
                $('#stamp_config').attr({
                    "disabled": true,
                }).parent().addClass('d-none');
            }
        });
        $("input[id='has-user-name']").change(function() {
            var cnt = $("input[id='has-user-name']:checked").length;

            if (cnt !== 0) {
                // $(this).prop("checked", "");

                $('#user_name_config').attr({
                    "disabled": false,
                }).parent().removeClass('d-none');

            } else {
                $('#user_name_config').attr({
                    "disabled": true,
                }).parent().addClass('d-none');
            }
        });

        $("input[id='has-lawyer-name']").change(function() {
            var cnt = $("input[id='has-lawyer-name']:checked").length;

            if (cnt !== 0) {
                // $(this).prop("checked", "");

                $('#lawyer_name_config').attr({
                    "disabled": false,
                }).parent().removeClass('d-none');

            } else {
                $('#lawyer_name_config').attr({
                    "disabled": true,
                }).parent().addClass('d-none');
            }
        });
        $("input[id='show-sign-date']").change(function() {
            var cnt = $("input[id='show-sign-date']:checked").length;

            if (cnt !== 0) {
                // $(this).prop("checked", "");

                $('#signed_date_config').attr({
                    "disabled": false,
                }).parent().removeClass('d-none');

            } else {
                $('#signed_date_config').attr({
                    "disabled": true,
                }).parent().addClass('d-none');
            }
        });

        $("#full-screen-button").on("click", function(e) {
            openFullscreen('f-row');
        });

        $("#remove-full-screen-button").on("click", function(e) {
            closeFullscreen();
        });

        $("#append-button").on("change", function(e) {
            var to = this.value;
            var y = $("#get-y").val();
            var x = $("#get-x").val();
            var page = $("#page_number").val();


            // var value = page+'::'+x+'|'+y;
            var value = {
                page: page,
                x: x,
                y: y
            }

            $("#" + to).attr({
                "disabled": false,
            }).parent().removeClass('d-none');

            $("#" + to).parent().prev().find("input").attr('checked', true);

            var oldValue = $("#" + to).val();
            // alert(oldValue.length)
            if (oldValue.length !== 0) {
                newValue = $("#" + to).val();
                // alert(newValue)
                newValue = JSON.parse(newValue);
            } else {
                newValue = [$("#" + to).val()];
                newValue = newValue.filter(el => {
                    return el != null && el != '';
                });
                // alert(newValue)
            }

            newValue.push(value);


            $("#" + to).val(JSON.stringify(newValue, undefined, 5));
            // alert(JSON.stringify(newValue))
            // closeFullscreen();
        });


        var openFullscreen = function(id) {

            var element = document.getElementById(id);
            if (element.requestFullscreen) {
                element.requestFullscreen()
            } else if (element.webkitRequestFullscreen) {
                /* Safari */
                element.webkitRequestFullscreen()
            } else if (element.msRequestFullscreen) {
                /* IE11 */
                element.msRequestFullscreen()
            }

            $("#full-screen-button").addClass('d-none')
            $("#remove-full-screen-button").removeClass('d-none')
            $("#hide-preview-text").addClass('d-none')
            $("#hide-y-text").addClass('d-none')
            $("#hide-x-text").addClass('d-none')
            $("#hide-page-number-text").addClass('d-none')
            $("#hide-append-text").addClass('d-none')

        }

        /* Close fullscreen */
        function closeFullscreen() {
            $("#full-screen-button").removeClass('d-none')

            $("#remove-full-screen-button").addClass('d-none')
            $("#hide-preview-text").removeClass('d-none')
            $("#hide-y-text").removeClass('d-none')
            $("#hide-x-text").removeClass('d-none')
            $("#hide-page-number-text").removeClass('d-none')
            $("#hide-append-text").removeClass('d-none')
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                /* Safari */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                /* IE11 */
                document.msExitFullscreen();
            }
            //   $("#exclude-in-fullscreen-mode").removeClass('d-none')

        }
        $('#pdfViewer').mousemove(function(event) {
            var position = $("#pdfViewer").offset();
            
           //Get Coordinate & Convert to PX DPI 72
            var x_coordinate = (event.pageX-position.left);
            var y_coordinate = (event.pageY-position.top);

            //format according to element width and height
            x = (x_coordinate / 3) * 4;
            y = (y_coordinate / 3) * 4;
            x = pxTomm(x);
            y = pxTomm(y);
            //
            $("#cursor").css('left', x_coordinate-1.0);
            $("#cursor").css('top', y_coordinate-7.2);

            
            $("#work-space").on('click', function(event) {
                $("#get-x").val(x.toPrecision(3));
                $("#get-y").val(y.toPrecision(3));
                $("#x-coord").text(x.toPrecision(3));
                $("#y-coord").text(y.toPrecision(3));
            });
            $("#coords").text("X: " + x.toPrecision(3) + ", Y: " + y.toPrecision(3));


            
        });
        

        $("#pdfViewe").mousemove(function(event) {
            var position = $("#pdfViewer").offset();
            
            // $("#coords").text(position.left + ", " + position.top);
            $("#coords").text((event.pageX-position.left) + ", " + (event.pageY-position.top));
            $(this).css("background-color", "lavender");
            // alert("relatedTarget is: " + position.x);
        });
        // $("button").click(function() {
        //     $("p").mousemove();
        // });
        // $().on("click", function(e) {
        //     $("#full-screen-button").removeClass('d-none')

        //     $("#remove-full-screen-button").addClass('d-none')
        //     $("#hide-preview-text").removeClass('d-none')
        //     $("#hide-y-text").removeClass('d-none')
        //     $("#hide-x-text").removeClass('d-none')
        //     $("#hide-page-number-text").removeClass('d-none')
        //     $("#hide-append-text").removeClass('d-none')
        //     if (document.exitFullscreen) {
        //         document.exitFullscreen();
        //     } else if (document.webkitExitFullscreen) {
        //         /* Safari */
        //         document.webkitExitFullscreen();
        //     } else if (document.msExitFullscreen) {
        //         /* IE11 */
        //         document.msExitFullscreen();
        //     }
        // });

        var pxTomm = function(px) {
            //mm = ( pixels * 25.4 ) / DPI
            var mm = (Number(px) * 25.4) / 72;
            // var mm = px;
            //    return Math.floor(px/($('#pdfViewer').height()/100)); //JQuery returns sizes in PX
            return mm;
        };
        var elmids = ['pdfViewer'];

        var x, y = 0; // variables that will contain the coordinates

        // Get X and Y position of the elm (from: vishalsays.wordpress.com)
        function getXYpos(elm) {
            x = elm.offsetLeft; // set x to elm’s offsetLeft
            y = elm.offsetTop; // set y to elm’s offsetTop

            elm = elm.offsetParent; // set elm to its offsetParent

            //use while loop to check if elm is null
            // if not then add current elm’s offsetLeft to x
            //offsetTop to y and set elm to its offsetParent
            while (elm != null) {
                x = parseInt(x) + parseInt(elm.offsetLeft);
                y = parseInt(y) + parseInt(elm.offsetTop);
                elm = elm.offsetParent;
            }

            // returns an object with "xp" (Left), "=yp" (Top) position
            return {
                'xp': x,
                'yp': y
            };
        }

        // Get X, Y coords, and displays Mouse coordinates
        function getCoords(e) {
            // coursesweb.net/
            var xy_pos = getXYpos(this);

            // if IE
            if (navigator.appVersion.indexOf("MSIE") != -1) {
                // in IE scrolling page affects mouse coordinates into an element
                // This gets the page element that will be used to add scrolling value to correct mouse coords
                var standardBody = (document.compatMode == 'CSS1Compat') ? document.documentElement : document.body;

                x = event.clientX + standardBody.scrollLeft;
                y = event.clientY + standardBody.scrollTop;
            } else {
                x = e.pageX;
                y = e.pageY;
            }

            x = x - xy_pos['xp'];
            y = y - xy_pos['yp'];

            //Format My
            x = pxTomm(x);
            y = pxTomm(y);

            x = (x / 3) * 4;
            y = (y / 3) * 4;

            // displays x and y coords in the #coords element
            // document.getElementById('coords').innerHTML = '(X= ' + x.toPrecision(3) + ' ,Y= ' + y.toPrecision(3) + ')';
            // // document.getElementById('get-x').value = x.toPrecision(3);
            // document.getElementById('get-y').value = y.toPrecision(3);

        }

        // register onmousemove, and onclick the each element with ID stored in elmids
        for (var i = 0; i < elmids.length; i++) {
            if (document.getElementById(elmids[i])) {
                // calls the getCoords() function when mousemove
                document.getElementById(elmids[i]).onmousemove = getCoords;

                // execute a function when click
                document.getElementById(elmids[i]).onclick = function() {
                    // document.getElementById('regcoords').value = x.toPrecision(3) + ' , ' + y.toPrecision(3);
                    // document.getElementById('get-x').value = x.toPrecision(3);
                    // document.getElementById('get-y').value = y.toPrecision(3);
                };
            }
        }
    </script>
    <script>
        // if (document.getElementById('editor')) {
        //   var quill = new Quill('#editor', {
        //     theme: 'snow' // Specify theme in configuration
        //   });
        // }

        if (document.getElementById('assign_to_lawyer')) {
            var element = document.getElementById('assign_to_lawyer');
            const example = new Choices(element, {
                removeItemButton: true
            });
        }
        if (document.getElementById('type')) {
            var element = document.getElementById('type');
            const example = new Choices(element, {
                removeItemButton: true
            });
        }

        if (document.querySelector('.datetimepicker')) {
            flatpickr('.datetimepicker', {
                allowInput: true
            }); // flatpickr
        }

        Dropzone.autoDiscover = false;
        var drop = document.getElementById('dropzone')
        var myDropzone = new Dropzone(drop, {
            url: "/file/post",
            addRemoveLinks: true

        });
    </script>
    <script src="{{ asset('/assets/js/plugins/multistep-form.js') }}"></script>
    <!-- Toastr -->
    {{-- <script src="{{ asset('/assets/js/plugins/jquery/jquery-3.3.1.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/toastr/toastr.min.js') }}"></script> --}}
@endsection
