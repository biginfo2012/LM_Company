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
                                <h4 class="card-title mb-0">{{__('my-page')}}</h4>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="card-text">
                                <p>{{__('employee-name')}}: <span id="name">{{\Illuminate\Support\Facades\Auth::user()->name}}</span></p>
                                <p>{{__('email')}}: <span id="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span></p>
                                <p>{{__('phone')}}: <span id="phone">{{\Illuminate\Support\Facades\Auth::user()->contact}}</span></p>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center mt-2">
                                    <a href="{{route('employee.inquiry')}}" type="button" class="btn btn-outline-secondary waves-effect">{{__('inquiry')}}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
</x-user-layout>
