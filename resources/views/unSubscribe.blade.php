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
        <h1 >Leiratkozás</h1>
        <hr>
        <p>Az alábbi gombbal tudsz leiratkozni a hírlevélről. A továbbiakban nem fogsz emaileket kapni az újdonágokkal kapcsolatban.
            Később azonban bármikor újra feliratkozhatsz.
        </p>
        <i>{{$email}} - {{$name}}</i>
        
        <br>
        <form action="/rm-sub" method="POST">
        @csrf
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="name" value="{{$name}}" hidden>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="name" name="email" value="{{$email}}" hidden>
            <button type="submit">Leiratkozás</button>
        </form>
    </div>
</body>
</html>