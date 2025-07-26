@extends("layout._layout_all")

@section("include-opt")
    @vite("resources/css/components/_container.css")
    @vite("resources/css/components/_navbar.css")
    @vite("resources/css/components/_modal.css")
    @vite("resources/css/components/_buttons.css")
    @vite("resources/css/login.css")

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="/js/utils.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

@endsection

@section("login")
<div class="login-container">
    <!-- Judul -->
    <div class="login-container-text">
        <span class="login-txt">Login</span>
    </div>

    <div class="login-container-form">
        <form method="post" action="/api/auth" id="login-form">
            <!-- Pilihan Role -->
            <div class="form-radio-field">
                <input type="radio" name="role" id="student" value="student" onclick="changeform_placeholder()">
                <label for="student">Siswa</label>

                <input type="radio" name="role" id="pengajar" value="pengajar" onclick="changeform_placeholder()">
                <label for="pengajar">Pengajar</label>

                <input type="radio" name="role" id="superadmin" value="superadmin" onclick="changeform_placeholder()">
                <label for="superadmin">Admin</label>
            </div>

            <!-- Input Identity -->
            <div class="form-field input-group">
                <i class="bi bi-person-circle icon-left"></i>
                <input id="identity" type="text" name="identity" placeholder="nomor ujian" required>
            </div>

            <!-- Input Password -->
            <div class="form-field input-group">
                <i class="bi bi-key icon-left"></i>
                <input id="password" type="password" name="password" placeholder="password" required>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="login-btn-container">
                <input class="login-btn" type="submit" value="Login">
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    function changeform_placeholder() {
        if ($("#superadmin").is(":checked") || $("#pengajar").is(":checked")) {
            $("#identity").prop("placeholder", "username");
        } else {
            $("#identity").prop("placeholder", "nomor ujian");
        }
    }

    setInterval(function () {
        setHtml("nav-time-js", getTimeStr());
    }, 1000);

    $("#login-form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            success: function (data) {
                if (data["status"] == false) {
                    show_modal("Perhatian", data["message"]);
                } else {
                    window.location.href = data["redirect"];
                }
            },
            error: function (data) {
                show_modal("Perhatian", data.responseJSON["message"]);
            }
        });
    });
</script>
@endsection
