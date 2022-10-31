<x-admin-layout>
    <!--begin::Content-->
    <style>
        #the-canvas {
            border: 1px solid black;
            direction: ltr;
            width: 50%;
            height: auto;
        }
    </style>
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div
                                class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h4 class="card-title mb-0">{{__('add-doc')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <form class="form" id="save_form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{isset($data) ? $data['id'] : ''}}">
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="doc-code" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('doc-code')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="text" id="doc-code" class="form-control" placeholder="" value="{{isset($data) ? $data['doc_code'] : $code}}" tabindex="1" disabled/>
                                                <input type="hidden" name="doc_code" value="{{isset($data) ? $data['doc_code'] : $code}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="doc-name" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('doc-name')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="text" id="doc-name" class="form-control" name="name" placeholder="" value="{{isset($data) ? $data['name'] : ''}}" required tabindex="2"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-12">
                                        <div class="mb-1 row">
                                            <label for="formFile" class="col-sm-1 col-form-label-lg"
                                                   style="padding-right: 0">{{__('doc-file')}}</label>
                                            <div class="col-sm-5" style="padding-left: 0">
                                                <input class="form-control" type="file" id="formFile" accept="application/pdf" name="file" {{isset($data) ? '' : 'required'}}/>
                                                @isset($data)
                                                    <a href="{{route('company.doc-download', $data['id'])}}">{{$data['file_name']}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($data))
{{--                                        <div class="mb-1 col-md-12">--}}
{{--                                            <div class="mb-0">--}}
{{--                                                <button class="btn btn-flat-dark waves-effect" id="prev">Previous</button>--}}
{{--                                                <button class="btn btn-flat-dark waves-effect" id="next">Next</button>--}}
{{--                                                &nbsp; &nbsp;--}}
{{--                                                <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>--}}
{{--                                            </div>--}}

{{--                                            <canvas id="the-canvas"></canvas>--}}
{{--                                        </div>--}}
                                        <div class="mb-1 col-md-12">
                                            <div class="mb-1 row">
                                                <label for="remarks" class="col-sm-1 col-form-label-lg"
                                                       style="padding-right: 0">{{__('viewer')}}</label>
                                                <div class="col-sm-11" style="padding-left: 0">
                                                    <p class="mb-0" style="margin-top: 10px">{{$data['viewer']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-12">
                                            <div class="mb-1 row">
                                                <label for="remarks" class="col-sm-1 col-form-label-lg"
                                                       style="padding-right: 0">{{__('agree')}}</label>
                                                <div class="col-sm-11" style="padding-left: 0">
                                                    <p class="mb-0" style="margin-top: 10px">{{$data['agree']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-12">
                                            <div class="mb-1 row">
                                                <label for="remarks" class="col-sm-1 col-form-label-lg"
                                                       style="padding-right: 0">{{__('unread')}}</label>
                                                <div class="col-sm-11" style="padding-left: 0">
                                                    <p class="mb-0" style="margin-top: 10px">{{$data['unread']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary me-1 btn_submit" onclick="event.preventDefault();saveForm('{{route('company.doc-save')}}')">{{__('register')}}</button>
                                        @if(isset($data))
                                            <button type="reset" class="btn btn-dark waves-effect waves-float waves-light me-1" onclick="event.preventDefault();deleteData({{$data['id']}}, '{{route('company.doc-delete')}}')">{{__('delete')}}</button>
                                        @endif
                                        <label class="btn btn-outline-secondary waves-effect" id="btn_cancel">{{__('cancel')}}</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>--}}
{{--    <script>--}}
{{--        // If absolute URL from the remote server is provided, configure the CORS--}}
{{--        // header on that server.--}}
{{--        //var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';--}}
{{--        var url = '{{asset('upload').'/'.$data['url']}}';--}}
{{--        console.log(url)--}}
{{--        var doc_id = $('#doc_id').val();--}}
{{--        var doc_type = $('#doc_type').val();--}}
{{--        // Loaded via <script> tag, create shortcut to access PDF.js exports.--}}
{{--        var pdfjsLib = window['pdfjs-dist/build/pdf'];--}}
{{--        // The workerSrc property shall be specified.--}}
{{--        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';--}}
{{--        var pdfDoc = null,--}}
{{--            pageNum = 1,--}}
{{--            pageRendering = false,--}}
{{--            pageNumPending = null,--}}
{{--            scale = 0.8,--}}
{{--            canvas = document.getElementById('the-canvas'),--}}
{{--            ctx = canvas.getContext('2d');--}}
{{--        /**--}}
{{--         * Get page info from document, resize canvas accordingly, and render page.--}}
{{--         * @param num Page number.--}}
{{--         */--}}
{{--        function renderPage(num) {--}}
{{--            pageRendering = true;--}}
{{--            // Using promise to fetch the page--}}
{{--            pdfDoc.getPage(num).then(function(page) {--}}
{{--                var viewport = page.getViewport({scale: scale});--}}
{{--                canvas.height = viewport.height;--}}
{{--                canvas.width = viewport.width;--}}
{{--                // Render PDF page into canvas context--}}
{{--                var renderContext = {--}}
{{--                    canvasContext: ctx,--}}
{{--                    viewport: viewport--}}
{{--                };--}}
{{--                var renderTask = page.render(renderContext);--}}
{{--                // Wait for rendering to finish--}}
{{--                renderTask.promise.then(function() {--}}
{{--                    pageRendering = false;--}}
{{--                    if (pageNumPending !== null) {--}}
{{--                        // New page rendering is pending--}}
{{--                        renderPage(pageNumPending);--}}
{{--                        pageNumPending = null;--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--            // Update page counters--}}
{{--            document.getElementById('page_num').textContent = num;--}}
{{--        }--}}
{{--        /**--}}
{{--         * If another page rendering in progress, waits until the rendering is--}}
{{--         * finised. Otherwise, executes rendering immediately.--}}
{{--         */--}}
{{--        function queueRenderPage(num) {--}}
{{--            if (pageRendering) {--}}
{{--                pageNumPending = num;--}}
{{--            } else {--}}
{{--                renderPage(num);--}}
{{--            }--}}
{{--        }--}}
{{--        /**--}}
{{--         * Displays previous page.--}}
{{--         */--}}
{{--        function onPrevPage() {--}}
{{--            if (pageNum <= 1) {--}}
{{--                return;--}}
{{--            }--}}
{{--            pageNum--;--}}
{{--            queueRenderPage(pageNum);--}}
{{--        }--}}
{{--        document.getElementById('prev').addEventListener('click', onPrevPage);--}}
{{--        /**--}}
{{--         * Displays next page.--}}
{{--         */--}}
{{--        function onNextPage() {--}}
{{--            if (pageNum >= pdfDoc.numPages) {--}}
{{--                return;--}}
{{--            }--}}
{{--            pageNum++;--}}
{{--            queueRenderPage(pageNum);--}}
{{--        }--}}
{{--        document.getElementById('next').addEventListener('click', onNextPage);--}}
{{--        /**--}}
{{--         * Asynchronously downloads PDF.--}}
{{--         */--}}
{{--        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {--}}
{{--            pdfDoc = pdfDoc_;--}}
{{--            document.getElementById('page_count').textContent = pdfDoc.numPages;--}}
{{--            // Initial/first page rendering--}}
{{--            renderPage(pageNum);--}}
{{--        });--}}
{{--    </script>--}}
</x-admin-layout>
