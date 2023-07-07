<?php
$keyword = $_GET['keyword'] ?? ($_GET['brand'] ?? false);

if ($keyword === false) {
  $keyword = 'No Data Found...';
}
include_once "./static/globals/head-tags.php"; ?>
</head>

<body>
  <div class="root">
    <div class="hero-container">
      <!-- HEADER -->
      <?php include_once "./static/globals/header.php"; ?>
      <!-- HERO -->
      <div class="hero-banner section-p">
        <div class="container-x txt-center">
          <div class="content">
            <?php if (isset($_GET['keyword'])) : ?>
            <h2>Search Assist</h2>
            <p class="mt-1 mb-2" style="border: none;">Results for:
              <span class="detail" style="font-size: 1rem;"><?= $keyword ?></span>
            </p>
            <?php else : ?>
            <h2>Super Brands</h2>
            <p class="mt-1 mb-2" style="border: none;">Results for:
              <span class="detail" style="font-size: 1rem;"><?= $keyword ?></span>
            </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Data -->
    <section class="site-lots" id="parts">
      <div class="container-x section-p">
        <h2><?= isset($_GET['keyword']) ? 'Recent Lots' : "On, $keyword" ?> </h2>
        <div class="main-grid-flow grid" id="recent">
          <div class="slot">
            Search Slot
          </div>
        </div>
      </div>
      <div class="grid-pagination">
        <div class="container">
          <ul class="pagination-lists flex gap-x">
            <li>
              <a href="?p-page=1#parts" class="paginate prev inactive">
                <i class="fas fa-angle-left"></i>
              </a>
            </li>
            <li>
              <a href="?p-page=1#parts" class="paginate active"> 1 </a>
            </li>
            <li>
              <a href="?p-page=1#parts" class="paginate"> 2 </a>
            </li>
            <li>
              <a href="?p-page=1#parts" class="paginate"> 3 </a>
            </li>
            <li>
              <span class="extend">...</span>
            </li>
            <li>
              <a href="?p-page=1#parts" class="paginate"> 20 </a>
            </li>
            <li>
              <a href="?p-page=1#parts" class="paginate next">
                <i class="fas fa-angle-right"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <?php include_once "./static/globals/footer.php"; ?>
</body>

</html>