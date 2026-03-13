<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>OPONY</title>
</head>

<body>
  <?php
  $server = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'opony';

  $connection = mysqli_connect($server, $user, $password, $database);
  header('refresh: 10; url=opony.php');
  ?>
  <main id="blok_glowny">
    <?php
    $query = "SELECT opony.nr_kat, opony.producent, opony.model, opony.sezon, opony.cena FROM opony ORDER BY opony.cena ASC LIMIT 10;";
    $result = mysqli_query($connection, $query);
    echo "<section id='blok_boczny'>";
    while ($row = mysqli_fetch_row($result)) {
      if ($row[3] == 'letnia') {
        $type = 'lato';
      } elseif ($row[3] == 'zimowa') {
        $type = 'zima';
      } else {
        $type = 'uniwer';
      }

      echo
        "<div class='opona'>
        <img class='sticker' src='img/$type.png' alt='opona' />
        <h4 class='table_text'>Opona: $row[1] $row[2]</h4>
        <div class='line'>
          <h3>Cena: $row[4]</h3>
        </div>
      </div>";
    }
    echo "<a href='https://opona.pl'>więcej ofert</a>
    </section>";
    ?>
    <?php
    $query = "SELECT opony.producent, opony.model, opony.sezon, opony.cena FROM opony WHERE opony.nr_kat = 9;";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($result);

    echo "<section id='sekcja_1'>
      <img id='opona_img' src='img/opona.png' alt='Opona' />
      <h2>Opona dnia</h2>
      <h2>$row[0] model $row[1]</h2>
      <h2>Sezon: $row[2]</h2>
      <h2>Tylko $row[3] zl!</h2>
    </section>"
      ?>
    <?php
    $query = "SELECT zamowienie.id_zam, zamowienie.ilosc, opony.model, opony.cena FROM zamowienie INNER JOIN opony ON opony.nr_kat=zamowienie.nr_kat ORDER BY RAND() LIMIT 1;";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($result);
    $value = $row[1] * $row[3];

    echo "<section id='sekcja_2'>
      <h2>Najnowsze zamowienie</h2>
      <h2>$row[0] $row[1] sztuki modelu $row[2]</h2>
      <h2>Wartosc zamowienia $value</h2>
    </section>";

    $query = mysqli_close($connection);
    ?>
  </main>
  <footer id="blok_stopki">
    <p>Stronę wykonał: 000000000</p>
  </footer>
</body>

</html>