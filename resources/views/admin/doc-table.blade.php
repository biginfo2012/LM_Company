<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">{{__('doc-code')}}</th>
        <th class="text-center">{{__('doc-name')}}</th>
        <th class="text-center">{{__('dist-date')}}</th>
        <th class="text-center">{{__('dist-cnt')}}</th>
        <th class="text-center">{{__('view-cnt')}}</th>
        <th class="text-center">{{__('agree-cnt')}}</th>
        <th class="text-center">{{__('unread-cnt')}}</th>
        <th class="text-center"></th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$index+1}}</td>
            <td class="p-0 border text-center align-middle">{{$item['doc_code']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['name']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['dist_date']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['dist']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['view']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['agree']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['unread']}}</td>
            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['id']}}">
                <a href="{{route('company.doc-edit', $item['id'])}}" class="btn btn-outline-dark waves-effect ex_change" style="padding: 8px; margin: 5px;">{{__('edit')}}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
