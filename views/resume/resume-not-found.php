  <!-- GLOBALS -->
  <?php include_once __DIR__ . "/../globals/globals.php" ?>

  <title>Untitled | Resume</title>
  <link rel="stylesheet" href="/static/styles/create_new.css" />
  <style type="text/css">
#my_resume_wrapper {
  margin: auto;
  overflow: hidden;
  margin: auto;
  width: 100%;
  max-width: 550px;
  border: 2px solid #333333ae;
  border-radius: 0.5em;
  box-shadow: 1px 2px 20px #333;
  cursor: zoom-in;
}

#my_resume_main {
  width: 1000px;
  transform-origin: 0 0;
}

/*// Loader*/
#page_loader {
  position: fixed;
  width: 100vw;
  display: grid;
  grid-template-columns: repeat(2, 50%);
  z-index: 1500;
  top: 0;
}

#page_loader.loaded {
  display: none !important;
}

#page_loader .load_page {
  height: 100vh;
  /*pointer-events: none;*/
}

#page_loader .layer_content {
  cursor: wait;
  background-color: rgba(0, 0, 0, 0.4);
}

#page_loader .sync {
  padding: 0.5em 1em;
  border-radius: 0.35em;
  background-color: var(--clr-white);
  color: var(--clr-bg);
  font-size: 0.8rem;
  box-shadow: 6px 10px 28px 0px rgba(0, 0, 0, 0.4);
}

#page_loader .layer_preview {
  box-shadow: 6px 10px 28px 0px rgba(0, 0, 0, 0.4);
  background-color: var(--clr-white);
  /*color: var(--clr-bg);*/
  cursor: alias;
}
  </style>
  </head>

  <body>
    <div class="root">
      <div class="create-resume">
        <header class="main-header flex between gap-1">
          <a href="/dashboard/"><span class="clr-danger">Res</span>ume</a>

          <div class="title flex-1 txt-center" style="overflow: hidden">
            <p class="txt-ellipsis">Resume Title</p>
          </div>

          <div class="actions flex gap-1">
            <button class="bbtn primary flex gap-x btn_save_resume">
              <i class="fas fa-trash"></i> Clear
            </button>
            <button class="bbtn primary flex gap-x btn_save_resume">
              <i class="fas fa-save"></i> Save
            </button>
            <button class="bbtn primary flex gap-x">
              CV <i class="pl-1 fas fa-caret-down"></i>
            </button>
            <button class="bbtn secondary pre flex gap-x">
              <i class="fas fa-download pr-x"></i> Download
            </button>
          </div>
        </header>
        <div id="page_loader">
          <div class="load_page layer_content flex">
            <p class="sync flex gap-1">
              <span class="loader inline-text"></span>
              <span>Syncing ...</span>
            </p>
          </div>
          <div class="load_page layer_preview flex">
            <p>Please wait ...</p>
          </div>
        </div>
        <main class="container-main">RESUME NOT FOUND: create a resume <div class="btn btn-p">proceed</div>
        </main>
      </div>
      <!-- Toast Modul -->
      <?php include_once __DIR__ . "/../globals/toast-module.php" ?>
    </div>

    <script src="/static/scripts/jQuery.min.js"></script>
  </body>

  </html>