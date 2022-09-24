<x-user-layout>
    <style>
        .card-text > p > span{
            margin-left: 10px;
        }
        .noti-title{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <div class="card mb-2">
        <div class="card-body">
            <h4 class="card-title">{{__('current-doc')}}</h4>
            <div class="card-text">
                <p>{{__('view-doc')}}: <span id="view">{{$view}}</span></p>
                <p>{{__('agree-doc')}}: <span id="agree">{{$agree}}</span></p>
                <p>{{__('unread-doc')}}: <span id="unread">{{$unread}}</span></p>
            </div>
            <a href="{{route('employee.doc-check')}}" class="card-link" style="float: right">{{__('check-doc')}}</a>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-body">
            <h4 class="card-title">{{__('noti-check')}}</h4>
            <div class="card-text">
                @foreach($noti as $item)
                    <p>{{date('Y.m.d', strtotime($item->created_at))}} <span class="noti-title">{{$item->title}}</span></p>
                @endforeach
            </div>
            <a href="{{route('employee.noti-check')}}" class="card-link" style="float: right">{{__('to-list')}}</a>
        </div>
    </div>
</x-user-layout>
