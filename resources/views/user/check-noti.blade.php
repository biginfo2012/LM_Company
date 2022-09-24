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
                        <div class="card-body p-0">
                            <form class="dt_adv_search" method="POST" id="search_form">
                                @csrf
                            </form>
                        </div>
                        <div class="card-body pb-1">
                            <div class="border-bottom">
                                <h4 class="card-title mb-0">{{__('noti-check')}}</h4>
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
            getTableDataNo('{{route('employee.noti-table')}}');
        });
    </script>
</x-user-layout>
