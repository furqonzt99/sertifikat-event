<html>
<style type="text/css" media="all">
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

{{-- body {
        width: 29.7cm;
        height: 21cm;
        margin: 0cm;
        padding: 0cm;
   } --}}

@page {
    size: 21cm 29.7cm;
    margin: 0;
  }

body {
  padding: -1.2cm;
  position: relative;
}

img {
    width:29.7cm;
    height:21cm;
    object-fit:cover;
    position: absolute;
  }

h1 {
    text-align: center;
    font-size: 36pt;
    font-family: 'Roboto', sans-serif;
    font-weight: 700;
    color: #1F5C6F;
    position: relative;
    align-items: center;
    top: 28%;
  }

p {
    text-align: center;
    font-size: 18pt;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    color: #FBA01C;
    position: relative;
    align-items: center;
    top: 24%;
}

</style>
<body>
    <img src="{{ public_path('template/'. $event->sertifikat) }}">
    <p>No. {{ $nomor }}</p>
    <h1>{{ ucwords($peserta->nama)}}</h1>

</body>
</html>
