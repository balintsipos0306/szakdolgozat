<div class="modal fade" id="reg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Regisztráció</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/webshop/registrate" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Felhasználónév</label>
            <input type="text" class="form-control" aria-describedby="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" aria-describedby="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" aria-describedby="password" name="password" required>
          </div>
          <div class="form-check" id="check">
            <input name="checkbox" type="checkbox" class="form-check-input" value="true">
            <label class="form-check-label" for="checkbox">Feliratkozom a hírlevélre</label>
          </div>
          <div class="buttons">
              <button type="submit" class="btn btn-primary">Regisztrálás</button>
          </div>
        </form>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#login">Vissza</button>
      </div>
    </div>
  </div>
</div>