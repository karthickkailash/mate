<!DOCTYPE html>
<html>

<head>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        html,
        body {
            min-height: 100%;
        }

        body,
        div,
        form,
        input,
        select,
        textarea,
        label {
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
            line-height: 22px;
        }

        h1 {
            position: absolute;
            margin: 0;
            font-size: 40px;
            color: #ffffff;
            z-index: 2;
            line-height: 83px;
        }

        .testbox {
            display: flex;
            justify-content: center;
            align-items: center;
            height: inherit;
            padding: 20px;
        }

        form {
            width: 100%;
            padding: 20px;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 0 8px #cc7a00;
        }

        .banner {
            position: relative;
            height: 300px;
            background-image: url("/media/banner/banner_travel.png");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .banner::after {
            content: "";
            background-color: rgba(0, 0, 0, 0.2);
            position: absolute;
            width: 100%;
            height: 100%;
        }

        input,
        select,
        textarea {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input {
            width: calc(100% - 10px);
            padding: 5px;
        }

        input[type="date"] {
            padding: 4px 5px;
        }

        textarea {
            width: calc(100% - 12px);
            padding: 5px;
        }

        .item:hover p,
        .item:hover i,
        .question:hover p,
        .question label:hover,
        input:hover::placeholder {
            color: #cc7a00;
        }

        .item input:hover,
        .item select:hover,
        .item textarea:hover {
            border: 1px solid transparent;
            box-shadow: 0 0 3px 0 #cc7a00;
            color: #cc7a00;
        }

        .item {
            position: relative;
            margin: 10px 0;
        }

        .item span {
            color: red;
        }

        input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }

        .item i,
        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            font-size: 20px;
            color: #cc7a00;
        }

        .item i {
            right: 1%;
            top: 30px;
            z-index: 1;
        }

        [type="date"]::-webkit-calendar-picker-indicator {
            right: 1%;
            z-index: 2;
            opacity: 0;
            cursor: pointer;
        }

        input[type=radio],
        input[type=checkbox] {
            display: none;
        }

        label.radio {
            position: relative;
            display: inline-block;
            margin: 5px 20px 15px 0;
            cursor: pointer;
        }

        .question span {
            margin-left: 30px;
        }

        .question-answer label {
            display: block;
        }

        label.radio:before {
            content: "";
            position: absolute;
            left: 0;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            border: 2px solid #ccc;
        }

        input[type=radio]:checked+label:before,
        label.radio:hover:before {
            border: 2px solid #cc7a00;
        }

        label.radio:after {
            content: "";
            position: absolute;
            top: 6px;
            left: 5px;
            width: 8px;
            height: 4px;
            border: 3px solid #cc7a00;
            border-top: none;
            border-right: none;
            transform: rotate(-45deg);
            opacity: 0;
        }

        input[type=radio]:checked+label:after {
            opacity: 1;
        }

        .btn-block {
            margin-top: 10px;
            text-align: center;
        }

        button {
            width: 150px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #cc7a00;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #ff9800;
        }

        @media (min-width: 568px) {

            .name-item,
            .city-item {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .name-item input,
            .name-item div {
                width: calc(50% - 20px);
            }

            .name-item div input {
                width: 97%;
            }

            .name-item div label {
                display: block;
                padding-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @includeIf('nav')
    <div class="testbox">
        <form action="{{ url('/submit-form') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="banner">
                <h1>Registration Form</h1>
            </div>
            <p>Consultant Information</p>
            <div class="item">
                <label for="name">Name<span>*</span></label>
                <input id="name" type="text" name="name" />
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="item">
                <label for="email">Email Address<span>*</span></label>
                <input id="email" type="email" name="email" />
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="item">
                <label for="address">Address<span>*</span></label>
                <input id="address" type="address" name="address" />
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="item">
                <label for="phone">Phone<span>*</span></label>
                <input id="phone" type="number" name="phone" />
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="item">
                <label for="bdate">Date of Birth<span>*</span></label>
                <input id="bdate" type="date" name="bdate" />
                <i class="fas fa-calendar-alt"></i>
                @error('bdate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="question">
                <label>Gender<span>*</span></label>
                <div class="question-answer">
                    <div>
                        <input type="radio" value="male" id="radio_1" name="gender" />
                        <label for="radio_1" class="radio"><span>Male</span></label>
                    </div>
                    <div>
                        <input type="radio" value="female" id="radio_2" name="gender" />
                        <label for="radio_2" class="radio"><span>Female</span></label>
                    </div>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <label>Profile Image <span>*</span></label>
            <input type="file" id="myFile" name="filename">
            <img id="preview" src="" alt="Image Preview"
                style="display: none; width: 200px; height: auto; margin-top: 10px;">
            @error('filename')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <label>Document <span>*</span></label>
            <input type="file" id="myFile" name="docname">


            <div class="btn-block">
                <button type="submit" href="/">SUBMIT</button>
            </div>
        </form>
        {{-- <form id="registrationForm" action="{{ url('/submit-form') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="banner">
                <h1>Registration Form</h1>
            </div>
            <p>Consultant Information</p>

            <div class="item">
                <label for="name">Name<span>*</span></label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" />
                <span class="text-danger error-message" id="nameError"></span>
            </div>

            <div class="item">
                <label for="email">Email Address<span>*</span></label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" />
                <span class="text-danger error-message" id="emailError"></span>
            </div>

            <div class="item">
                <label for="address">Address<span>*</span></label>
                <input id="address" type="text" name="address" value="{{ old('address') }}" />
                <span class="text-danger error-message" id="addressError"></span>
            </div>

            <div class="item">
                <label for="phone">Phone<span>*</span></label>
                <input id="phone" type="number" name="phone" value="{{ old('phone') }}" />
                <span class="text-danger error-message" id="phoneError"></span>
            </div>

            <div class="item">
                <label for="bdate">Date of Birth<span>*</span></label>
                <input id="bdate" type="date" name="bdate" value="{{ old('bdate') }}" />
                <span class="text-danger error-message" id="bdateError"></span>
            </div>

            <div class="question">
                <label>Gender</label>
                <div class="question-answer">
                    <div>
                        <input type="radio" value="male" id="radio_1" name="gender" />
                        <label for="radio_1" class="radio"><span>Male</span></label>
                    </div>
                    <div>
                        <input type="radio" value="female" id="radio_2" name="gender" />
                        <label for="radio_2" class="radio"><span>Female</span></label>
                    </div>
                </div>
                <span class="text-danger error-message" id="genderError"></span>
            </div>

            <div class="item">
                <label for="myFile">Upload File<span>*</span></label>
                <input type="file" id="myFile" name="filename">
                <img id="preview" src="" alt="Image Preview"
                    style="display: none; width: 200px; height: auto; margin-top: 10px;">
                <span class="text-danger error-message" id="filenameError"></span>
            </div>

            <div class="btn-block">
                <button type="submit">SUBMIT</button>
            </div>
            <!-- Success Message -->
            <div id="successMessage" class="alert alert-success" style="display: none;">Data stored successfully!</div>

        </form> --}}


    </div>
    @includeIf('footer')
</body>

</html>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registrationForm').submit(function(e) {
            e.preventDefault(); // Prevent form from submitting normally

            var formData = new FormData(this); // Get form data
            $('.error-message').text(''); // Clear previous error messages

            $.ajax({
                url: "{{ url('/submit-form') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#successMessage').show(); // Show success message
                        setTimeout(function() {
                            location.reload(); // Reload page after 2 seconds
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + 'Error').text(value[
                                0]); // Display errors below fields
                        });
                    }
                }
            });
        });

        // Show image preview
        $('#myFile').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
        $("#myFile").change(function(event) {
            var file = event.target.files[0]; // Get selected file
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr("src", e.target.result).show(); // Set image source and show
                };
                reader.readAsDataURL(file); // Read file as Data URL
            }
        });
    });
</script>
