
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym Attendance Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #111;
            min-height: 100vh;
            color: white;
        }

        .sidebar h3 {
            padding: 25px 15px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 13px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #333;
        }

        .stat-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 25px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
        }

        .table th {
            background: #222;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar">
            <h3>GYM APP</h3>

            <a href="{{ route('members.index') }}">Dashboard</a>
            <a href="{{ route('members.index') }}">Members</a>
            <a href="{{ route('members.create') }}">Add Member</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">

            <h2 class="fw-bold">Dashboard</h2>
            <p class="text-secondary">Gym Attendance Management System</p>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- STATISTICS -->
            <div class="row g-3 mt-3">

                <div class="col-md-4">
                    <div class="stat-card">
                        <p>Total Members</p>
                        <div class="stat-number">{{ $total }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card">
                        <p>Male Members</p>
                        <div class="stat-number">{{ $male }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card">
                        <p>Female Members</p>
                        <div class="stat-number">{{ $female }}</div>
                    </div>
                </div>

            </div>

            <!-- MEMBERS TABLE -->
            <div class="bg-white rounded p-4 mt-4 shadow-sm">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">

                    <h4 class="mb-0">Gym Members</h4>

                    <a href="{{ route('members.create') }}" class="btn btn-dark">
                        + Add Member
                    </a>

                </div>

                <!-- SEARCH -->
                <form action="{{ route('members.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search name, email, or phone..."
                            value="{{ request('search') }}"
                        >

                        <button type="submit" class="btn btn-dark">
                            Search
                        </button>

                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </form>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Membership</th>
                                <th style="min-width: 150px;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($members as $member)

                                <tr>
                                    <td>{{ $member->id }}</td>

                                    <td>{{ $member->name }}</td>

                                    <td>{{ $member->email }}</td>

                                    <td>{{ $member->phone }}</td>

                                    <td>{{ $member->gender }}</td>

                                    <td>
                                        <span class="badge bg-dark">
                                            {{ $member->membership_type }}
                                        </span>
                                    </td>

                                    <!-- EDIT AND DELETE -->
                                    <td>
                                        <div class="action-buttons">

                                            <a
                                                href="{{ route('members.edit', $member->id) }}"
                                                class="btn btn-sm btn-primary">
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('members.destroy', $member->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this member?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center text-secondary p-4">
                                        No members registered yet.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $members->appends(request()->query())->links() }}
                </div>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
