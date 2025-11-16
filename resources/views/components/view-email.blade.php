<link rel="stylesheet" href="{{asset('css/emailModal.css')}}">
<script src="{{asset('js/adminEmails.js')}}"></script>

<div class="modal fade" id="viewEmail" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <strong>Tárgy:</strong>
                    <span id="emailSubject"></span>
                </p>
                <p>
                    <strong>Címzettek:</strong>
                </p>
                <ul id="emailRecipients"></ul>
                <p>
                    <strong>Szöveg:</strong>
                </p>
                <div id="emailBody" class="border rounded p-2 mb-3 bg-light"></div>
                <p>
                    <strong>Küldés ideje:</strong>
                    <span id="emailCreated"></span>
                </p>
            </div>
        </div>
    </div>
</div>