<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swojska Chata | najlepsze obiady domowe!</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
  </head>
  <body>
    <header>
      <nav>
        <?php
          include_once 'snippets/navigation.php';
        ?>
      </nav>
      <div id="banner">
        <div>
          <h1>Swojska Chata</h1>
          <h2>Najlepsze obiady domowe w okolicy</h2>
        </div>
        <img src="images/banner.jpg" alt="baner">
      </div>
    </header>
    <main>
      <section class="contact">
        <h2>Zapraszamy do kontaktu:</h2>
        <a href="mailto:example@example.pl"><span class="material-icons">email</span> example@example.pl</a><br>
        <a href="tel:+48225553040"><span class="material-icons">call</span> (+48) 22 555 30 40</a><br>
        <span class="material-icons">location_on</span> ul. Krótka 11 00-001 Miasto<br>
      </section>
      <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1479.505218798846!2d21.993673986872178!3d51.41736188751752!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47227bda101593f9%3A0x19cce2b7303ced95!2zS3LDs3RrYSAxMSwgMjQtMTAwIFB1xYJhd3k!5e0!3m2!1spl!2spl!4v1623513234562!5m2!1spl!2spl" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </main>
    <?php
      include_once 'snippets/footer.php';
    ?>
  </body>
</html>
