<x-user-layout>
    <style>
        thead{
            display: none;
        }
        td{
            border: none !important;
        }
    </style>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mt-2 pb-0">
                            <form class="dt_adv_search" method="POST" id="search_form">
                                @csrf
                                <div class="row g-1 mb-md-0">
                                    <div class="col-md-12">
                                        <div class="mb-0 row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="colFormLabel" name="name"
                                                       placeholder="{{__('please-input-file-name')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-0 row">
                                            <div class="col-md-8">
                                                <select class="form-select" id="type" name="type">
                                                    <option value="">{{__('all')}}</option>
                                                    <option value="1">{{__('viewed')}}</option>
                                                    <option value="2">{{__('agreed')}}</option>
                                                    <option value="0">{{__('unreaded')}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mt-2 text-end">
                                                <button class="btn btn-success" id="btn_get_table"
                                                        onclick="event.preventDefault();getTableDataNo('{{route('employee.doc-table')}}')">検　索
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body pb-1">
                            <div class="border-bottom">
                                <h4 class="card-title mb-0">{{__('doc-list')}}</h4>
                            </div>
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
        addEventListener('pageshow', (event) => {
            getTableDataNo('{{route('employee.doc-table')}}');
        });
    </script>
</x-user-layout>
