<div class="container">
    <h2>User Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>User ID:</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Customer:</th>
            <td>{{ $user->name ?? 'Guest' }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>${{ $user->email }}</td>
        </tr>



    </table>


 


</div>

