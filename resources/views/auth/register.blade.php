   {{-- <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script> --}}




        {{-- <select name="role" required>
            <option value="instructor">Instructor</option>
            <option value="student">Student</option>
        </select> --}}



        @extends('layouts.app')

        @section('content')
        <div class="container-md">
            <h1 class="pt-5">Register Form</h1>
            <form id="registrationForm" class="row g-2" method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" class="form-control" name="name" placeholder="Name" required>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="instructor" value="instructor" checked>
                        <label class="form-check-label" for="instructor">
                            Instructor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="student" value="student">
                        <label class="form-check-label" for="student">
                            Student
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
        <div id="responseMessage"></div>

        <script>
            // Setup CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function submitForm() {
                var formData = $('#registrationForm').serialize(); // Serialize form data

                $.ajax({
                    url: "{{ route('register') }}", // Correct route reference
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#responseMessage').html('<p>Registration successful! Please login.</p>');
                        $('#registrationForm')[0].reset(); // Clear form fields
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '<ul>';
                        $.each(errors, function(key, value) {
                            errorMessage += '<li>' + value[0] + '</li>'; // Display each error message
                        });
                        errorMessage += '</ul>';
                        $('#responseMessage').html(errorMessage);
                    }
                });
            }
        </script>
        @endsection

