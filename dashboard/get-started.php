    <?php include_once "static/includes/headLinks.php"; ?>
    <style>
.get_started li {
  list-style-type: disc;
  list-style: disc;
  display: list-item;
}

.get_started ul {
  margin: 2rem;
}
    </style>
    </head>

    <body>
      <div id="root">
        <div class="dashboard-main">
          <div class="container">
            <?php include_once "static/includes/sideNav.php"; ?>
            <section class="main-content">
              <?php include_once "static/includes/header.php"; ?>
              <main>
                <!-- Page View Start -->

                <div class="get_started">
                  <h2>We will provide helpful links to resources that will guide you on how to use</h2>

                  <ul>
                    <li>The Editor</li>
                    <li>FIle Upload Features</li>
                    <li>And more...</li>
                  </ul>

                  <a href="/dashboard/" class="btn btn-s">Back to Dashboard</a>
                </div>
                <!-- Page View Ends -->
              </main>
            </section>
          </div>
        </div>
        <?php include_once "static/includes/footer.php"; ?>