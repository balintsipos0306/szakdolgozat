<div>
    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <strong class="me-auto text-success">Siker</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            {{ session('success') }}
            </div>
        </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('successToast');
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, { autohide: false });
                toast.show();
            }
        });
        </script>
    @endif

    @if ($errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
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
            const toastElement = document.getElementById('errorToast');
            if (toastElement) {
            const toast = new bootstrap.Toast(toastElement, { autohide: false });
            toast.show();
            }
        });
        </script>
    @endif
</div>