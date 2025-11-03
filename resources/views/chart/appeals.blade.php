<table class="table table-hover">
    <thead>
        <th>№</th>
        <th>Kitob nomi</th>
        <th>Soni</th>
    </thead>
    <tbody>
        @foreach($likeBooks as $key=> $item)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->book->title}}</td>
            <td>1</td>
        </tr>
        @endforeach

    </tbody>
</table>