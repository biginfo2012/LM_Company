<x-admin-layout>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div
                                class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h4 class="card-title mb-0">{{__('noti-manage')}}</h4>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div
                                        class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="dt-buttons">
                                            <a class="dt-button add-new btn btn-primary" href="{{route('company.noti-add')}}">
                                                <span>{{__('add-noti')}}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2 pb-0">
                            <form class="dt_adv_search" method="POST" id="search_form">
                                @csrf
                                <div class="row g-1 mb-md-0">
                                    <div class="col-md-2">
                                        <div class="mb-1 row">
                                            <label for="status" class="col-sm-3 col-form-label-lg"
                                                   style="padding-right: 0">{{__('status')}}</label>
                                            <div class="col-sm-9" style="padding-left: 0">
                                                <select class="form-select" id="status" name="status">
                                                    <option value="">{{__('all')}}</option>
                                                    <option value="2">{{__('done')}}</option>
                                                    <option value="0">{{__('yet')}}</option>
                                                    <option value="1">{{__('bottom')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-1 row">
                                            <div class="col-sm-12">
                                                <input type="text" id="report_date" class="form-control flatpickr-basic" name="report_date" placeholder="{{__('please-input-date')}}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-success mr-2" id="btn_get_table"
                                                onclick="event.preventDefault();getTableData('{{route('company.noti-table')}}')">検　索
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body pt-0" id="table-part">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
    <script>
        $(document).ready(function () {
            $('.flatpickr-basic').flatpickr();
        })
        addEventListener('pageshow', (event) => {
            getTableData('{{route('company.noti-table')}}');
        });
    </script>
</x-admin-layout>
