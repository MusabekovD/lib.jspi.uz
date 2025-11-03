<table class="table table-hover">
    <thead>
        <th>№</th>
        <th>Kalit so'z</th>
        <th>Soni</th>
    </thead>
    <tbody>
        @foreach($stat as $key=> $item)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->keyword}}</td>
            <td>{{$item->count_using}}</td>
        </tr>
        @endforeach

    </tbody>
</table>