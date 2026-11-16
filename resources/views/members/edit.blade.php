
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Gym Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="card shadow-sm mx-auto" style="max-width: 650px;">

        <div class="card-header bg-dark text-white p-3">
            <h4 class="mb-0">Update Gym Member</h4>
        </div>

        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('members.update', $member->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $member->name) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $member->email) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone', $member->phone) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male" {{ old('gender', $member->gender) == 'Male' ? 'selected' : '' }}>
                            Male
                        </option>
                        <option value="Female" {{ old('gender', $member->gender) == 'Female' ? 'selected' : '' }}>
                            Female
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Membership Type</label>
                    <select name="membership_type" class="form-select" required>
                        <option value="Basic" {{ old('membership_type', $member->membership_type) == 'Basic' ? 'selected' : '' }}>
                            Basic
                        </option>
                        <option value="Premium" {{ old('membership_type', $member->membership_type) == 'Premium' ? 'selected' : '' }}>
                            Premium
                        </option>
                        <option value="VIP" {{ old('membership_type', $member->membership_type) == 'VIP' ? 'selected' : '' }}>
                            VIP
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-dark">
                    Update Member
                </button>

                <a href="{{ route('members.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
