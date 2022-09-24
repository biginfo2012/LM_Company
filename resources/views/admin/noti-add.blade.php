<x-admin-layout>
    <!--begin::Content-->
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
                                    <h4 class="card-title mb-0">{{__('noti-add')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <input type="hidden" id="content" value="{{isset($data) ? $data->content : ''}}">
                            <form class="form" id="save_form">
                                @csrf
                                <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">
                                <div class="row">
                                    <div class="mb-1 col-md-12">
                                        <div class="mb-1 row">
                                            <label for="title" class="col-sm-1 col-form-label-lg"
                                                   style="padding-right: 0">{{__('title')}}</label>
                                            <div class="col-sm-11" style="padding-left: 0">
                                                <input type="text" id="title" class="form-control" name="title" placeholder="{{__('add-title')}}" value="{{isset($data) ? $data->title : ''}}" tabindex="1" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-12">
                                        <div class="mb-1 row">
                                            <label for="status" class="col-sm-1 col-form-label-lg"
                                                   style="padding-right: 0">{{__('status')}}</label>
                                            <div class="col-sm-3" style="padding-left: 0">
                                                <select class="form-select" id="status" name="status" tabindex="2">
                                                    <option value="2" {{isset($data) && $data->status == 2 ? 'selected' : ''}}>{{__('done')}}</option>
                                                    <option value="0" {{isset($data) && $data->status == 0 ? 'selected' : ''}}>{{__('yet')}}</option>
                                                    <option value="1" {{isset($data) && $data->status == 1 ? 'selected' : ''}}>{{__('bottom')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-12">
                                        <div class="mb-1 row">
                                            <label for="remarks" class="col-sm-1 col-form-label-lg"
                                                   style="padding-right: 0">{{__('content')}}</label>
                                            <div class="col-sm-11" style="padding-left: 0">
                                                <div class="summernote" id="summernote"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary me-1 btn_submit" id="save_noti">{{__('register')}}</button>
                                        @if(isset($data))
                                            <button type="reset" class="btn btn-dark waves-effect waves-float waves-light me-1" onclick="event.preventDefault();deleteData({{$data->id}}, '{{route('company.noti-delete')}}')">{{__('delete')}}</button>
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
    <script>
        $(document).ready(function () {
            //privacy contennt setting
            let content = $('#content').val();
            if(content != ""){
                $('#summernote').summernote('code', content);
            }
            else{
                $('#summernote').summernote();
            }
            $('#save_noti').click(function (e){
                e.preventDefault();
                let content = $('.summernote').summernote('code');
                if(content != "" && $('#save_form').valid()){
                    var paramObj = new FormData($('#save_form')[0]);
                    paramObj.append('detail', content);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    });
                    $.ajax({
                        url: '{{route('company.noti-save')}}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function(response){
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
                                toastr.success("成功しました。");
                                window.location = document.referrer;
                            }
                            else {
                                toastr.warning("失敗しました。");
                            }
                        },
                    });
                }
            })
        })
    </script>
</x-admin-layout>
