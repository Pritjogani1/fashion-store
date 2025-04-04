<x-adminlayout>

    <h1>Static Pages</h1>
    <a href="{{ route('admin.static-pages.create') }}" class="btn btn-primary">Create New Page</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <a href="{{ route('admin.static-pages.edit', $page->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.static-pages.destroy', $page->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-adminlayout>