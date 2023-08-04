<?php
$data = $edit_data ?? null;

?>


<title>About App</title>
<link rel="stylesheet" href="/static/styles/template-create.css">
</head>

<body>
  <div class="flower  section-p">
    <div class="avatar txt-center">
      <i class="fas fa-radiation"></i>
    </div>
    <h2 class="pt-2 pb-2mt-2 mb-2 txt-center">About Demo page</h2>
    <div class="links txt-center flex wrap">
      <a class="btn font-size-small clr-warning" href="/app/"><i class="fas fa-arrow-left"></i> Dashboard</a>
      <a class="btn font-size-small clr-warning" href="/templates/resume">Templates <i class="fas fa-arrow-right"></i>
      </a>
    </div>
    <main class="container-x main">
      <div class="layer previewer">
        <h3>About app </h3>
        <div class="content flex <?= $data ? 'data' : '' ?>">
          <img src="<?= $data ? "/resumes/thumbnails/" . $edit_data['thumbnail'] : '#' ?>" alt="Template">
          <div class="text">WELCOME</div>
        </div>
      </div>
      <div class="layer form" id="templates">
        <h3>App Templates</h3>
        <div class="content">
          <br>
          <br>
          templates are...
        </div>
      </div>
    </main>

    <div class="footer txt-center">
      <h5>Read more</h5> <a href="/about?templates" class="clr-warning">About creating a template</a>
    </div>
  </div>
</body>

</html>