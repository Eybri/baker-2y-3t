

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Profile') }}</title>
    <!-- Include Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include any other stylesheets or libraries needed -->
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #ffe4e1; /* Light pink background */
        }
        .bg-white {
            background-color: #ffb6c1 !important; /* Light pink for header */
        }
        .text-gray-800 {
            color: #d84315 !important; /* Darker pink for header text */
        }
        .card {
            border: 2px solid #ff69b4; /* Hot pink border */
            border-radius: 10px; /* Rounded corners for cards */
        }
        .card-body {
            background-color: #ffcccb; /* Light pink for card body */
        }
        .font-semibold {
            font-weight: 600; /* Make the header text bolder */
        }
        .text-xl {
            font-size: 1.5em; /* Increase the header text size */
        }
        .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow for header */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Navigation/Header -->
        <header class="bg-white shadow py-4">
            <div class="container">
                <h2 class="font-semibold text-xl text-gray-800">
                    {{ __('Profile') }}
                </h2>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include any JavaScript needed -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include any other scripts -->
</body>
</html>

