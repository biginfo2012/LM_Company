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
                                    <h4 class="card-title mb-0">{{__('employee-add')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <form class="form" id="save_form">
                                @csrf
                                <input type="hidden" name="id" value="{{isset($user) ? $user->id : ''}}">
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="employee-code" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('employee-code')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="text" id="employee-code" class="form-control" placeholder="" value="{{isset($user) ? $user->user_code : $code}}" tabindex="1" disabled/>
                                                <input type="hidden" name="user_code" value="{{isset($user) ? $user->user_code : $code}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="employee-name" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('employee-name')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="text" id="employee-name" class="form-control" name="name" placeholder="" value="{{isset($user) ? $user->name : ''}}" required tabindex="2"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="user-id" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('user-id')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="email" id="user-id" class="form-control" name="email" placeholder="" value="{{isset($user) ? $user->email : ''}}" required tabindex="3"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="password" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('password')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="password" id="user-id" class="form-control" name="password" placeholder="" {{isset($user) ? '' : 'required'}} tabindex="4"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="department" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('department')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="text" id="department" class="form-control" name="department" placeholder="" value="{{isset($user) ? $user->department : ''}}" required tabindex="8"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="post-code" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('post-code')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="number" id="post-code" class="form-control" name="post_code" placeholder="" value="{{isset($user) ? $user->post_code : ''}}" required tabindex="5"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="address" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('address')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="text" id="address" class="form-control" name="address" placeholder="" value="{{isset($user) ? $user->address : ''}}" required tabindex="6"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <div class="mb-1 row">
                                            <label for="contact" class="col-sm-2 col-form-label-lg"
                                                   style="padding-right: 0">{{__('contact')}}</label>
                                            <div class="col-sm-10" style="padding-left: 0">
                                                <input type="number" id="contact" class="form-control" name="contact" placeholder="" value="{{isset($user) ? $user->contact : ''}}" required tabindex="7"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-12">
                                        <div class="mb-1 row">
                                            <label for="status" class="col-sm-1 col-form-label-lg"
                                                   style="padding-right: 0">{{__('status')}}</label>
                                            <div class="col-sm-5" style="padding-left: 0">
                                                <select class="form-select" id="status" name="status" tabindex="9">
                                                    <option value="1" {{isset($user) && $user->status == 1 ? 'selected' : ''}}>{{__('enable')}}</option>
                                                    <option value="0" {{isset($user) && $user->status == 0 ? 'selected' : ''}}>{{__('stop')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-12">
                                        <div class="mb-1 row">
                                            <label for="remarks" class="col-sm-1 col-form-label-lg"
                                                   style="padding-right: 0">{{__('remarks')}}</label>
                                            <div class="col-sm-11" style="padding-left: 0">
                                                <textarea rows="5" id="remarks" class="form-control" name="remarks" placeholder="" tabindex="10">{{isset($user) ? $user->remarks : ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-primary me-1 btn_submit" onclick="event.preventDefault();saveForm('{{route('company.employee-save')}}')">{{__('register')}}</button>
                                        @if(isset($user))
                                            <button type="reset" class="btn btn-dark waves-effect waves-float waves-light me-1" onclick="event.preventDefault();deleteData({{$user->id}}, '{{route('company.employee-delete')}}')">{{__('delete')}}</button>
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
</x-admin-layout>
