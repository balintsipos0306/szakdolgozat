@php use Illuminate\Support\Str; @endphp

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Admin/admin.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <link rel="stylesheet" href="css/Admin/send-email.css">
    <title>Sipos Bálint - Szerkesztő felület</title>
</head>
<body id="page">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

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
  <x-view-email/>
  <x-admin-header/>

  <main>
    <h1>Körlevelek</h1>

    <div class="container" id="newOrEditEmail">
        <x-new-letter/>
    </div>

    @php
      $emails = DB::table('newsletter')->get();
    @endphp


    <div class="container" id =table>
      <table class="table table-hover">
        <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Tárgy</th>
          <th scope="col">Szöveg</th>
          <th scope="col">Címzett</th>
          <th scope="col">Küldés időpontja</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($emails as $mail)
            @php
              $recipients = json_decode($mail->emails, true) ?? [];
              $recipientDisplay = implode(', ', array_slice($recipients, 0, 2));
              if (count($recipients) > 2) {
                  $recipientDisplay .= '...';
              }
            @endphp

            <tr data-bs-toggle="modal"
              data-bs-target="#viewEmail"
              data-id="{{ $mail->id }}"
              data-title="{{ $mail->title }}"
              data-body="{{ $mail->body }}"
              data-emails="{{$mail->emails }}"
              data-created="{{ $mail->created_at }}"
            >
              <td>{{ $mail->id }}</td>
              <td>{{ Str::limit($mail->title, 40) }}</td>
              <td>{{ Str::limit($mail->body, 60) }}</td>
              <td>{{ $recipientDisplay }}...</td>
              <td>{{ $mail->created_at }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>

</body>
</html>