<x-user-layout>
    <style>
        #the-canvas {
            border: 1px solid black;
            direction: ltr;
            width: 100%;
            height: auto;
        }
    </style>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('employee.doc-check')}}" style="font-size: 12px">{{__('to-doc-list')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 m-2 mb-0 border-bottom position-relative">
                            <h4 class="card-title mb-0">{{$data['name']}}</h4>
                            <p class="mb-0 position-absolute top-0" style="right: 0">{{date('Y.m.d', strtotime($data['created_at']))}}</p>
                        </div>
                        <div class="card-body mt-2">
                            <div class="row">
                                <div class="col-md-12">
{{--                                    <embed--}}
{{--                                        src="{{ action('App\Http\Controllers\EmployeeController@getDocument', ['id'=> $data['id']]) }}"--}}
{{--                                        style="width:100%; height:800px;"--}}
{{--                                        frameborder="0"--}}
{{--                                    >--}}
{{--                                    <object data="https://drive.google.com/viewerng/viewer?embedded=true&url=http://health.ntuh.gov.tw/health/NTUH_e_Net/NTUH_e_Net_no91/%E7%99%8C%E7%97%87%E7%AF%A9%E6%AA%A2.pdf" type="application/pdf">--}}
{{--                                        <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=http://health.ntuh.gov.tw/health/NTUH_e_Net/NTUH_e_Net_no91/%E7%99%8C%E7%97%87%E7%AF%A9%E6%AA%A2.pdf" type='application/pdf'>--}}
{{--                                    </object>--}}
{{--                                    <object data="{{asset('upload').'/'.$data['url']}}" type="application/pdf" width="100%" height="100%">--}}
{{--                                        <p>Your web browser doesn't have a PDF plugin.--}}
{{--                                            Instead you can <a href="{{asset('upload').'/'.$data['url']}}">click here to--}}
{{--                                                download the PDF file.</a></p>--}}
{{--                                    </object>--}}
{{--                                    <iframe src="{{asset('upload').'/'.$data['url']}}" style="width: 100%; height: 500px;"></iframe>--}}

                                    <div class="mb-0">
                                        <button class="btn btn-flat-dark waves-effect" id="prev">Previous</button>
                                        <button class="btn btn-flat-dark waves-effect" id="next">Next</button>
                                        &nbsp; &nbsp;
                                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                                    </div>

                                    <canvas id="the-canvas"></canvas>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-0" style="padding: 10px 0; background: #459ee6 !important; color: black; font-weight: bolder">
                                        <div class="form-check" style="width: fit-content; margin: auto">
                                            <input class="form-check-input" type="checkbox" {{$type == 2 ? 'checked' : ''}} id="agree" tabindex="3" name="remember" disabled/>
                                            <label class="form-check-label" for="agree"> {{__('agreed-doc')}} </label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$data['id']}}" id="doc_id">
                                <input type="hidden" value="{{$type}}" id="doc_type">
                                <div class="col-md-12 text-center mt-1">
                                    <a href="{{route('employee.doc-check')}}" type="button" class="btn btn-outline-secondary waves-effect">{{__('back')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
{{--    <script src="{{ asset('theme/pdfjs/build/pdf.js') }}"></script>--}}
{{--    <script src="https://cdnjs.com/libraries/pdf.js"></script>--}}
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        //var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

        var url = '{{asset('upload').'/'.$data['url']}}';
        var change_url = '{{route('employee.doc-change')}}';
        var doc_id = $('#doc_id').val();
        var doc_type = $('#doc_type').val();

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var pdfjsLib = window['pdfjs-dist/build/pdf'];

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 0.8,
            canvas = document.getElementById('the-canvas'),
            ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
            if(num == pdfDoc.numPages){
                if(doc_type != 2){
                    $('#agree')[0].disabled = false;
                }
                if(doc_type == 0){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    });
                    $.ajax({
                        url: change_url,
                        type:'post',
                        data: {
                            id : doc_id,
                            type: 1
                        },
                        success: function (response) {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            if(response.status == true){
                                // toastr.success("成功しました。");
                            }
                            else {
                                toastr.warning("失敗しました。");
                            }
                        },
                        error: function () {

                        }
                    });
                }
            }
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });

        $('#agree').change(function() {
            if(this.checked) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: change_url,
                    type:'post',
                    data: {
                        id : doc_id,
                        type: 2
                    },
                    success: function (response) {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        if(response.status == true){
                            toastr.success("同意しました。");
                            $('#agree')[0].disabled = true;
                        }
                        else {
                            toastr.warning("失敗しました。");
                        }
                    },
                    error: function () {

                    }
                });
            }
        });

    </script>
</x-user-layout>
