<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/mainPage.css">
  <link rel="stylesheet" href="css/scrollbar.css">
  <title>Kezdőlap - Sipos Bálint</title>
</head>
<body id="page">
  <div class="loader">
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="js/scroll.js"></script>

  <x-base-header/>
    
  <main id = "main">
    <div class="slide">
      <div class="container">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="webp/tinywow_DSC_9983_65856104.webp" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="webp/tinywow_DSC_1090-Enhanced-NR_65855998.webp" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="webp/tinywow_DSC_1521_47197966.webp" class="d-block w-100" alt="...">
              </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div id="carouselExampleSlidesOnly2" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="webp/DSC_9266.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="webp/tinywow_DSC_4602_65856490.webp" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="webp/tinywow_DSC_4578_86100232.webp" class="d-block w-100" alt="...">
            </div>
          </div>
        </div>
      </div>
    </div>
      
    <div class="title">
      <h1>Bemutatkozás</h1>
      <hr id="hr" class="border border-black border-2 opacity-100">
    </div>

    <div class="about">
      <div class="imgholder">
        <img src="../me.jpg" alt="">
      </div>
      <section>
        <p>Sipos Bálint vagyok, {{date('Y')-2003}} éves, jelenleg a szombathelyi ELTE-n tanulok Programtervező Informatikus szakon. 2019 őszén kezdtem el a természetfotózást egy jégmadár miatt.</p>
        <p>2019 nyár elején elmentem édesapámmal evezni a Szigetközbe, ahol nyáron vízitúravezetőként dolgozok és akkor láttunk nagyon közelről egy jégmadarat és akkor jutott eszembe, hogy milyen jó lenne, ha tudnék egy saját képet készíteni róla (egy teljesen légből kapott ötletként). Miután ezt eldöntöttem még hónapokig fényképezőgép se volt a kezemben, de utána október körül elkezdtem fotózni. November közepére sikerült is elkészítenem az első viszonylag közeli jégmadár képemet.</p>
        <p>2022 óta foglalkozok komolyabb szinten a fotózással, ebben az évben került sor az első önálló kiállításomra, ebben az évben kerültem be a Szigetközi Természetfotós Egyesületbe, további ebben az évben jelentek meg először képeim újságokban.</p>
        <p>Azóta számos kiállításon jelentek meg képeim a Szigetközi Természetfotós Egyesület tagjaként, továbbá a Turista Magazin, National Geographic, Szigetközélet közösségi média felületein gyakran jelennek meg képeim.</p>
        <p>Újságokban is sikerült párszor megjelennem képeimmel (Természet Világa magazin, Állatvilág magazin, Varázslatos Magyarország Magazin). A Dadalia photopage pályázat és a Varázslatos Magyarország pályázat legjobb képeiből rendezett kiállításon is jelentek meg képeim.</p>
        <p>2023-ban kezdtem el a portré és rendezvényfotózással is foglalkozni. Zengő Ferenc barátomtól nagyon sokat tanulhatok mind portré mind esküvőfotózás terén.</p>
      </section>
    </div>
  </main>

  <x-base-footer/>
  <script src="js/main.js"></script>
</body>
</html>