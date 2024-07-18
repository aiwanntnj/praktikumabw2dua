@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function confirmDelete(userId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            axios.delete(`/users/${userId}`)
            .then(response => {
                swal("Poof! Your user has been deleted!", {
                    icon: "success",
                });
                location.reload();
            })
            .catch(error => {
                swal("Failed to delete user!", {
                    icon: "error",
                });
            });
        }
    });
}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });

    function confirmDelete(userId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                axios.delete(`/users/${userId}`)
                .then(response => {
                    swal("Poof! Your user has been deleted!", {
                        icon: "success",
                    });
                    location.reload();
                })
                .catch(error => {
                    swal("Failed to delete user!", {
                        icon: "error",
                    });
                });
            }
        });
    }
</script>
@endpush
@endsection

</script>
@endsection
