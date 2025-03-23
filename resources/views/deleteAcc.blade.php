<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipos Bálint - Leiratkozás</title>
    <link rel="stylesheet" href="../css/unsub.css">
</head>
<body>
    <div class="main">
        <div class="logoholder">
            <img src="../webp/tinywow_Logó.webp">
        </div>
        <h1 >Fiók törlése</h1>
        <hr>
        <p>Az alábbi gombbal tudod törölni a fiókod. Továbbiakban a hírlevélről is le tudsz iratkozni ha korábban már feliratkoztál.
        </p>
        <i>{{$email}} - {{$name}}</i>
        
        <br>
        <form action="/rm-sub" method="POST">
        @csrf
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name" value="{{$name}}" hidden>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="email" value="{{$email}}" hidden>
            <button type="submit">Leiratkozás</button>
        </form>
        <form action="/rm-acc" method="POST">
        @csrf
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name" value="{{$name}}" hidden>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="email" value="{{$email}}" hidden>
            <button type="submit">Fiók törlése</button>
        </form>
    </div>
</body>
</html>