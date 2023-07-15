<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JS PRO AJAX</title>
  <style>
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

    main {
      background-color: #ddd;
      padding: 10px;
    }
  </style>
</head>

<body>
  <h2>Javascript Pro: <button onclick="getLoadData()">Get Data</button></h2>
  <main></main>
  <script src="/static/jQuery.min.js"></script>
  <script>
    data = {
      education: 'object',
      experience: 'array'
    };

    console.time();

    function getLoadData() {
      $('main').load('data.php', {
        data: data
      })
      // $.post('data.php', {
      //   data: data
      // }, function(e, a) {
      //   $('main').html(e)
      // })
    }
    console.timeEnd()
  </script>
</body>

</html>