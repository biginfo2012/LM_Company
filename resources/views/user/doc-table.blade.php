<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">{{__('dist-date')}}</th>
        <th class="text-center">{{__('doc-name')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 text-start align-middle">{{date('Y.m.d', strtotime($item['created_at']))}}</td>
            <td class="p-0 text-start align-middle"><a href="{{route('employee.doc-detail', $item['id'])}}">{{$item['name']}}</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
