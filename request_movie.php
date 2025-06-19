<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Request Movie</title>
  <link rel="stylesheet" href="css/requestMovie.css" />
</head>
<body>

  <?php include("header.php"); ?>

  <div class="form-container">
    <h2>Request a Movie</h2>
    <form action="submit_request.php" method="POST" enctype="multipart/form-data">
      
      <label for="title">Movie Title:</label>
      <input type="text" id="title" name="title" required />

      <label for="description">Description:</label>
      <textarea id="description" name="description" rows="5" required></textarea>

      <label for="image">Upload Image:</label>
      <input type="file" id="image" name="image" accept="image/*" required />

      <label for="trailer">Trailer URL (YouTube):</label>
      <input type="url" id="trailer" name="trailer" placeholder="https://www.youtube.com/watch?v=..." required />

      <label for="category">Category:</label>
      <select id="category" name="category" required>
        <option value="">--Select Category--</option>
        <option value="Hollywood">Hollywood</option>
        <option value="Bollywood">Bollywood</option>
        <option value="Kollywood">Kollywood</option>
        <option value="Tollywood">Tollywood</option>
        <option value="Nollywood">Nollywood</option>
        <option value="UK">United Kingdom</option>
        <option value="China">Cinema of China</option>
      </select>

      <label for="theater_name">Preferred Theater:</label>
      <input type="text" id="theater_name" name="theater_name" required />

      <button type="submit">Submit Movie Request</button>
    </form>
  </div>

  <?php include("footer.php"); ?>

</body>
</html>
