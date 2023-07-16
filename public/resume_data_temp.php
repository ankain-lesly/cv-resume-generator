<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .image {
      max-width: 500px;
      margin: 1rem auto;
      border-radius: 1rem;
      overflow: hidden;
    }

    img {
      max-width: 100%;
    }

    h2 {
      text-align: center;
    }

    table {
      border: 2px solid #333;
      border-collapse: collapse;
      margin: auto;
    }

    th {
      background-color: black;
      color: #fff;
    }

    td,
    th {
      border: 2px solid #333;
      padding: 0.5rem 1rem;
    }

    #wrapper {
      position: relative;
      /* width: 100; */
      max-width: max-content;
      padding: 1rem;
      /* height: 590px; */
      margin: 0 auto;
      overflow: hidden;
    }

    #content {
      border: 5px solid #555;
      padding: 1rem;
      border-radius: 1rem;
      /* width: 900px; */
      width: 600px;
      margin: auto;
      background-color: #fff;
      box-shadow: 0 0 10px #333;

      position: relative;
      /* width: 1024px; */
      /* height: 590px; */
      transform-origin: 0 0;
    }
  </style>
</head>

<body>
  <div id="wrapper">
    <div id="content">
      <h2>My Resume Pro</h2>
      <div class="image">
        <img src="/static/photo.png" alt="" />
      </div>
      <div class="table">
        <h2>Resume Attr List Below</h2>
      </div>
      <table>
        <thead>
          <tr>
            <th>Section</th>
            <th>type</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $data = $_POST['data'] ?? [];
          foreach ($data as $key =>
            $value) { ?>
            <tr>
              <td><?= $key ?></td>
              <td><?= $value ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="/static/jQuery.min.js"></script>
  <script>
    //Responsive Scaling
    let wrapper = document.getElementById("wrapper"),
      content = document.getElementById("content"),
      maxWidth = content.clientWidth,
      maxHeight = content.clientHeight;

    window.addEventListener("resize", resize);
    resize();

    function resize() {
      let scale,
        width = window.innerWidth,
        height = window.innerHeight,
        // isMax = width >= maxWidth && height >= maxHeight;
        isMax = width >= maxWidth;

      if (!isMax) {
        // Update this calculation
        // scale = Math.min(width / maxWidth, height / maxHeight);
        scale = Math.min(width / maxWidth);
        content.style.transform = `scale(${scale - 0.04})`;
      }
    }
  </script>
</body>

</html>
