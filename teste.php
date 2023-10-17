<!doctype html>
<html>
  <head>
    <title>Exemplo getElementById</title>
    <script>
      function mudarCor(novaCor) {
        var elemento = document.getElementById("para1");
        elemento.style.color = novaCor;
      }
    </script>
  </head>
  <body>
    <p id="para1">Algum texto de exemplo</p>
    <button onclick="mudarCor('blue');">Azul</button>
    <button onclick="mudarCor('red');">Vermelho</button>
  </body>
</html>