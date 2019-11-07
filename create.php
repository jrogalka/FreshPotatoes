<?php
/*
    require.php - Enables HTTP authentication to the page.
 */
    require 'authenticate.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Review</title>
</head>
<body>
<div id="wrapper">
  <div id="header">
      <h1>Fresh Potatoes - New Review</h1>
  </div> <!-- END div id="header" -->
  <ul id="menu">
    <li><a href="index.php" >Home</a></li>
    <li><a href="create.php">New Post</a></li>
    <li><a href="newMovie.php">New Movie</a></li>
  </ul> <!-- END ul id="menu" -->
  <div id="all_blogs">
    <form action="insert.php" method="post">
      <fieldset>
        <legend>New Movie Review</legend>

        <label for="movie">Movie</label>
        <select name="movie" id="movie">
          <option value="1">Lion King</option>
          <option value="2">Joker</option>
          <option value="3">John Wick Chapter 3</option>
          <option value="4">Blade Runner</option>
          <option value="5">Avengers: Endgame</option>
          <option value="6">Mission Impossible: Fallout</option>
          <option value="7">What We Do In The Shadows</option>
          <option value="8">A Dog's Purpose</option>
          <option value="9">Inglorious Bastards</option>
          <option value="10">Nightmare Before Christmas</option>
          <option value="11">Speed</option>
          <option value="12">Baby Driver</option>
        </select>
        
        <label for="title">Title</label>
        <input name="title" id="title" />
        <br/>
        <label for="content">Content</label>
        <textarea name="content" id="content" rows=10 cols=70></textarea>

        <input type="submit" name="command" value="Create" />
      </fieldset>
    </form>
  </div>
  <div id="footer">
      FreshPotatoes - No Rights Reserved
  </div> <!-- END div id="footer" -->
</div> <!-- END div id="wrapper" -->
</body>
</html>