<div class="container">
    <h2 class="mb-4">All users</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Email</th>


            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name ?? 'Guest' }}</td> <!-- Fetching user name -->
                <td>${{ $user->email}}</td>
                <td>
                    <a href="{{ route('adminusers.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('adminusers.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a> <!-- Edit button -->
                </td>
                <td>
                        @if(Auth::check())                                 
                    <form action="{{ route('adminusers.remove', $user->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type='submit'  class="remove-link text-danger" onclick="this.closest('form').submit()">Remove item</button>
                    </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Log in to remove product</a> 
                        @endif
                </td>




            </tr>
            @endforeach
        </tbody>
    </table>
</div>
