<?php 
  $error = null;
  $year = '';

  include_once __DIR__.'/../../../connect/Controllers/YearController.php';
  use App\Controllers\YearController;
  use App\Config\CustomLibrary;

  $YearObj = new YearController();

  // GET EDIT DATA
  if(isset($_GET['edit'])) {
    $Year = $YearObj->show($_GET['edit']);

    if(!$Year) 
      exit('<h4 class="clr-warning txt-center">Product Not Found</h4>');

    $id = $Year['id'];
    $year = $Year['title'];
  }
  
  if(isset($_POST['create_year'])) {
    $Year = $YearObj->create();

    if(isset($Year['error'])) {
      $error = $Year['error']['message'];
      $year = $Year['error']['data'];
    } else 
      CustomLibrary::setToast('Year Created Successfully. 😎', '/dashboard/view-product.php?view=years');
  }
?>
<div class="dashboard-main">
  <header class="">
    <div class="container-x flex between">
      <a href="/dashboard/" class="btn btn-s">Back</a>
      <h4>Product Year</h4>
    </div>
  </header>
  <!-- Form Errors -->

  <div class="form-container container-x">
    <nav class="">
      <h3 class="clr-success mb-1">Products Year</h3>
    </nav>
    <?= $error ? 
        "<p class='form-errors flex between'>
            <span>$error</span>
            <span class='fas fa-caret-left clr-white'></span>
          </p>" : '';
    ?>
    <!-- Product Name -->
    <div class="input-group">
      <input
        type="text"
        class="product-title"
        name="product-title"
        placeholder="Enter a year - 1990"
        autocomplete="off"
        autocapitalize="on"
        required
        value="<?=$year?>"
      />
    </div>
    <form method="post" action="" >
      <!-- Product Image -->
      <div class="form-section">
        <div class="head">
          <h3>Basic info</h3>
        </div>
        <div class="body">
          
        <div class="input-group">
              <label for="brand_title">Car Year</label>
              <input
                type="text"
                name="year_title"
                id="name"
                placeholder="Year 1990"
                required
                value="<?=$year?>"
              />
            </div>

        </div>
      </div>

      <div class="actions flex mt-2 end gap-2">
        <a href="/dashboard/" class="btn btn-s">Cancel</a>
        <button class="btn btn-p" type="submit" name="create_year">
          <span class="mr-1"> Save </span>
        </button>
      </div>
    </form>
  </div>
</div>