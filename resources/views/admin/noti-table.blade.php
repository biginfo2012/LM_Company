<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">{{__('report-date')}}</th>
        <th class="text-center">{{__('status')}}</th>
        <th class="text-center">{{__('title')}}</th>
        <th class="text-center"></th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $index => $item)
        <tr style="{{$item->status == 0 ? 'color: red' : ($item->status == 1 ? 'color: blue' : '')}}">
            <td class="p-0 border text-center align-middle">{{$index+1}}</td>
            <td class="p-0 border text-center align-middle">{{date('Y/m/d H:i', strtotime($item['created_at']))}}</td>
            <td class="p-0 border text-center align-middle">{{$item['status'] == 1 ? __('bottom') : ($item['status'] == 0 ? __('yet') : __('done'))}}</td>
            <td class="p-0 border text-center align-middle">{{$item['title']}}</td>
            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['id']}}">
                <a href="{{route('company.noti-edit', $item['id'])}}" class="btn btn-outline-dark waves-effect ex_change" style="padding: 8px; margin: 5px;">{{__('edit')}}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
