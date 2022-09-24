<x-user-layout>
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
                                    <a href="{{route('employee.noti-check')}}" style="font-size: 12px">{{__('to-noti-list')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 m-2 mb-0 border-bottom position-relative">
                            <h4 class="card-title mb-0">{{$data['title']}}</h4>
                            <p class="mb-0 position-absolute top-0" style="right: 0">{{date('Y.m.d', strtotime($data['created_at']))}}</p>
                        </div>
                        <div class="card-body mt-2">
                            <div class="row">
                                <input type="hidden" id="detail_value" value="{{$data['content']}}">
                                <div class="col-md-12" id="detail">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-1">
                                    <a href="{{route('employee.noti-check')}}" type="button" class="btn btn-outline-secondary waves-effect">{{__('back')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function (){
            let content = $('#detail_value').val()
            $('#detail').html(content);
        })
    </script>
    <!--end::Content-->
</x-user-layout>
