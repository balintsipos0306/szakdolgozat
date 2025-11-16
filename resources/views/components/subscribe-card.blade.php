    <link rel="stylesheet" href="{{asset('css/subscribeCard.css')}}">

    <div class="container">
      <div id="sub" class="card text-bg-success mb-3">
        <div class="card-header">Feliratkozás</div>
        <div class="card-body">
          <h5 class="card-title">Iratkozz fel a körlevélre, hogy emailben értesülj az új bejegyzésekről</h5>
          <form action="/sub" method="POST">
            @csrf
            <div class="input-group" id="inputs">
              <div class="g col-4">
                <label for="name" class="form-label">Keresztnév</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name">
              </div>
              <div class="g col-6" id="email">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="email">
              </div>
            </div>
            <button type="submit" class="btn btn-light">Feliratkozás</button>
          </form>
        </div>
      </div>
    </div>