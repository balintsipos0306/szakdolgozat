<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
    <title>Belépés - Sipos Bálint</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <div class="bg">
    <img src="../webp/tinywow_DSC_9413_65859380.webp" alt="">
    </div>

    @if ($errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <strong class="me-auto text-danger">Hiba</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.querySelector('.toast');
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, { autohide: false });
                toast.show();
            }
        });
        </script>
        @endif

    <div class="container">
        <h1>Belépés</h1>
        <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
        <label for="name" class="form-label">Felhasználónév</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name">
        </div>

        <div class="mb-3">
        <label for="password" class="form-label">Jelszó</label>
        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="password" name="password">
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-primary">Belépés</button>
            <a class="btn btn-secondary" href="/">Vissza</a>
        </div>

        </form>
    </div>
    
</body>
</html>