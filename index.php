<!DOCTYPE html>
<html>
<head>
  <title>Best Selling Artists</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
</head>
<style>
body {
  font-family:'Helvetica', 'Arial', sans-serif;
  background-color: #F2F2F2;
  color: #333;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #FFF;
  border-radius: 8px;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
}

.table {
  width: 100%;
  border-collapse: collapse;
  background-color: #FFF;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.table th,
.table td {
  padding: 10px;
  text-align: center;
}

.table th {
  background-color: #E6E6E6;
  font-weight: bold;
  color: #333;
}

.table td {
  border-bottom: 1px solid #ddd;
}

/* Hover effect */
.table tbody tr:hover {
  background-color: #F8F8F8;
  cursor: pointer;
}
#random-artist-container {
    padding-top: 50px;
    display: block;
    margin: 0 auto;
    text-align: center;
}

</style>
<body>
<div class="container">
  <h1>Top 10 Best-Selling Artists</h1>
  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th>Artist</th>
        <th>Genre</th>
        <th>Total Certified Units</th>
        <th>Claimed Sales</th>

      </tr>
    </thead>
    <tbody id="artist-table-body">
      <?php
        $xml = simplexml_load_file('data.xml');

        foreach ($xml->artist as $artist) {
          echo '<tr>';
          echo '<td>' . $artist->name . '</td>';
          echo '<td>' . $artist->Genre . '</td>';
          echo '<td>' . $artist->totalCertifiedUnits . '</td>';
          echo '<td>' . $artist->claimedSales . '</td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
</div>
<div id="info-container" class="container d-none">
  <h2 id="artist-name"></h2>
  <p id="albums-sold"></p>
  <p id="total-certified-units"></p>
</div>
<script>
  $(document).ready(function() {
    $(".table tbody tr").hover(function() {
      $(this).addClass("hover");
    }, function() {
      $(this).removeClass("hover");
    });

    $(".table tbody tr").click(function() {
      var artist = $(this).find("td:nth-child(1)").text();
      var totalCertifiedUnits = $(this).find("td:nth-child(3)").text();
      var claimedSales = $(this).find("td:nth-child(4)").text();

      $("#artist-name").text(artist);
      $("#total-certified-units").text("Total Certified Units: " + totalCertifiedUnits);
      $("#albums-sold").text("Claimed Sales: " + claimedSales);
      $("#info-container").removeClass("d-none");
    });

    $("#random-artist-button").click(function() {
      var artistRows = $(".table tbody tr");
      var randomIndex = Math.floor(Math.random() * artistRows.length);
      var randomArtistRow = artistRows[randomIndex];
      var randomArtist = {
        name: $(randomArtistRow).find("td:nth-child(1)").text(),
        Genre: $(randomArtistRow).find("td:nth-child(2)").text(),
        totalCertifiedUnits: $(randomArtistRow).find("td:nth-child(3)").text(),
        claimedSales: $(randomArtistRow).find("td:nth-child(4)").text()
      };

      $("#random-artist-name").text(randomArtist.name);
      $("#random-artist-Genre").text("Genre: " + randomArtist.Genre);
      $("#random-artist-units").text("Total Certified Units: " + randomArtist.totalCertifiedUnits);
      $("#random-artist-sales").text("Claimed Sales: " + randomArtist.claimedSales);

      $('html, body').animate({
        scrollTop: $("#random-artist-container").offset().top
      }, 800);
    });
  });
</script>

<div id="random-artist-container">
  <h2>Random Artist</h2>
  <div id="random-artist-info">
    <h3 id="random-artist-name"></h3>
    <p id="random-artist-Genre"></p>
    <p id="random-artist-units"></p>
    <p id="random-artist-sales"></p>
  </div>
  <button id="random-artist-button" class="center-button">Generate Random Artist</button>
</div>
</body>
</html>
