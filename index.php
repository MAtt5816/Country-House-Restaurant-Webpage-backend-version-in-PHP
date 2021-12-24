<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swojska Chata | najlepsze obiady domowe!</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/gallery.js"></script>
  </head>
  <body>
    <header>
      <nav class="at_index">
        <?php
          include_once 'snippets/navigation.php';
        ?>
      </nav>
      <div id="banner">
        <div>
          <h1>Swojska Chata</h1>
          <h2 class="at_index">Najlepsze obiady domowe w okolicy</h2>
        </div>
        <img src="images/banner.jpg" alt="baner" class="at_index">
      </div>
    </header>
    <main>
      <?php
        include_once 'snippets/announce_bar.php';
      ?>
    <!--  <div id="annonce_bar"><p>ZUPA DNIA: chłodnik litewski za 5 zł!!!&nbsp;&nbsp;&nbsp;***
&nbsp;&nbsp;&nbsp;23.06.2021 (środa) jesteśmy nieczynni. Przepraszamy&nbsp;&nbsp;&nbsp;***
&nbsp;&nbsp;&nbsp;W każdą niedzielę do zestawu obiadowego za min. 30 zł lody GRATIS&nbsp;&nbsp;&nbsp;***</p></div> -->
      <article class="main">
        <h2>Tradycyjne obiady kuchni polskiej</h2>
        <p>Swojska Chata działa już od 10 lat szczycząc się od początku niesłabnącą popularnością. U nas zdjesz pożywny i&nbsp;pełnowartościowy posiłek za przystępną cenę.</p>
      </article>
      <article class="main">
        <h2>Zestawy obiadowe i dania dnia</h2>
        <h3><i>tylko w lokalu</i></h3>
        <p>Odwiedzając nasz lokal osobiście możesz coddziennie skorzystać z promoji na zupę dnia i coddzienne inne danie mięsne oraz wybrać zestaw obiadowy w rewelacyjnej cenie.</p>
      </article>
      <div id="gallery"></div>
      <div id="welcome">
        Zapraszamy!
      </div>
    </main>
    <?php
      include_once 'snippets/footer.php';
    ?>
  </body>
</html>
