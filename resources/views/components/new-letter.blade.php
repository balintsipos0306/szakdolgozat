<div>
    <form id="form" action="/send-email-to-subs" method="POST">
    @csrf
      <h2>Új körlevél írása</h2>
      <div class="mb-3">
      <label for="Title" class="form-label">Tárgy</label>
      <input type="text" class="form-control" name="title" required>
      </div>
      <div class="mb-3">
      <label for="text" class="form-label">Szöveg</label>
      <textarea class="form-control" rows="5" name="text" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Küldés</button>
    </form>
</div>