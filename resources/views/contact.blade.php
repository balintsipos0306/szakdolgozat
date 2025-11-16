<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/scrollbar.css">
  <link rel="stylesheet" href="../css/contact.css">
  <title>Elérhetőségek - Sipos Bálint</title>
</head>
<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="../js/contactLoader.js"></script>
  <div class="loader">
  </div>


  <x-base-header/>
  <x-system-feedback/>

  <main>

    <div class="socials">
      <a href="https://www.instagram.com/balintportraits/" target="_blank"><img src="webp/Instagram_icon.png.webp" alt=""></a>
      <a href="https://www.facebook.com/balintsipos03" target="_blank"><img src="webp/images.jfif" alt=""></a>
      <a href="tel:+36705872912"><img src="webp/png-clipart-telephone-logo-iphone-telephone-call-smartphone-phone-electronics-text.png"></img></a>  
    </div>

    <div class="container" id="info">
      <div class="image">
        <img src="../webp/tinywow_DSC_6422_65925974.webp" alt="">
      </div>

      <div>
        <form action="/mail" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Név</label>
            <input class="form-control" id="validationTextarea" name="name" required></input>           
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email cím</label>
            <input class="form-control" id="validationTextarea" name="address" required></input>
          </div>
          <div class="mb-3">
            <label for="title" class="form-label">Tárgy</label>
            <input class="form-control" id="validationTextarea" name="title" required></input>
          </div>
          <div class="mb-3">
            <label for="text" class="form-label">Üzenet</label>
            <textarea class="form-control" id="validationTextarea" name="text" required></textarea>
          </div>      
          <div class="mb-3">
            <button class="btn btn-primary" type="submit">Email küldése</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <div style= "position: relative; margin-top: 2em">
    <x-base-footer/>
  </div>
</body>
</html>