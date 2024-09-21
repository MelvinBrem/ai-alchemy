<?php
require_once 'library/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type="module" src="/src/ts/main.ts"></script>

  <title>AI Alchemy</title>
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-12 col-md-3">
        <div class="item-list" id="item-list">
        </div>
      </div>
      <div class="col-12 col-md-9">
        <div class="item-container" id="item-container">
        </div>
      </div>
    </div>

  </div>

  <div id="item-template">
    <div class="item"></div>
  </div>
</body>

</html>