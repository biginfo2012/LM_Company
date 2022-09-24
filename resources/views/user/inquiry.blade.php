<x-user-layout>
    <style>
        .card-text > p > span{
            margin-left: 10px;
        }
    </style>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-1">
                            <div class="border-bottom">
                                <h4 class="card-title mb-0">{{__('inquiry')}}</h4>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form class="dt_adv_search" method="POST" id="send_form">
                                @csrf
                                <div class="row g-1 mb-md-0">
                                    <div class="col-md-12">
                                        <div class="mb-0 row">
                                            <div class="col-md-8">
                                                <label for="task">{{__('inquiry-task')}}</label>
                                                <select class="form-select" id="task" name="task">
                                                    <option value="">{{__('please-select')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="mb-0 row">
                                            <div class="col-sm-12">
                                                <label for="colFormLabel">{{__('inquiry-content')}}</label>
                                                <textarea rows="10" type="text" class="form-control" id="colFormLabel" name="content"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center mt-1">
                                        <a href="" type="button" class="btn btn-flat-dark waves-effect">{{__('send')}}</a>
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
</x-user-layout>
