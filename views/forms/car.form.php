<?php
$name = '';
$description = '';
$features = '';
$brandTitle = '';
$brandID = '';
$price = null;
$created_on = '';
$yearTitle = '';
$yearID = '';
$id = '';

$old_files = '';
$photos = '';

include_once __DIR__ . '/../../../connect/Models/DataAccess.php';
include_once __DIR__ . '/../../../connect/Controllers/CarController.php';

use App\Models\DataAccess;
use App\Controllers\CarController;
use App\Config\CustomLibrary;

$DataAccess = new DataAccess();
$sqlBrands = "SELECT brandID, title FROM tblbrands";
$sqlYears = "SELECT yearID, title FROM tblyears";

$Brands = $DataAccess->fetchAll($sqlBrands);
$Years = $DataAccess->fetchAll($sqlYears);
$carObj = new CarController();

// GET EDIT DATA
if (isset($_GET['edit'])) {
  $Car = $carObj->show($_GET['edit']);

  if (!$Car)
    exit('<h4 class="clr-warning txt-center">Product Not Found</h4>');

  $id = $Car['id'];

  $name = $Car['name'];
  $description = $Car['description'];
  $features = $Car['features'];
  $brandID = $Car['brandID'];
  $brandTitle = $Car['brand'];
  $price = $Car['price'];
  $created_on = $Car['created_on'];
  $yearID = $Car['yearID'];
  $yearTitle = $Car['year'];

  $old_files = $Car['photos'];
  $photos = json_decode($Car['photos'], true);
}

// SUBMIT DATA
if (isset($_POST['create_product'])) {

  if ($_POST['product_id']) {
    $CarController = $carObj->update($old_files);

    if ($CarController)
      CustomLibrary::setToast('Product Updated Successfully. 😎', '/dashboard/view-product.php?view=cars');
  } else {
    $CarController = $carObj->create();

    if ($CarController)
      CustomLibrary::setToast('Product Created Successfully. 😎', '/dashboard/view-product.php?view=cars');
  }
}
?>
<div class="dashboard-main">
  <header class="">
    <div class="container-x flex between">
      <a href="/dashboard/" class="btn btn-s">Back</a>
      <h4>Create Car</h4>
    </div>
  </header>
  <div class="form-container container-x">
    <nav class="">
      <h3 class="clr-success mb-1">Create a Car</h3>
      <p>Enter Car details below to proceed</p>
    </nav>
    <!-- Product Name -->
    <div class="input-group">
      <input type="text" class="product-title" name="product-title" placeholder="Enter Car name" autocomplete="off" required value="<?= $name ?>" />
    </div>
    <form method="post" action="" enctype="multipart/form-data">
      <!-- Product Image -->
      <div class="form-section">
        <div class="head">
          <h3>Images</h3>
        </div>
        <div class="body">
          <div class="file-group product-upload-gallery <?= $photos ? 'selected' : '' ?>">
            <div class="upload-area">
              <input type="file" name="photos[]" id="photos" multiple accept="image/png,image/jpg,image/jpeg" />
              <label for="photos" class="upload-btn">
                <p class="flex gap-1">
                  <i class="fas fa-radiation"></i>
                  <span>ADD IMAGES</span>
                </p>
              </label>
            </div>
            <div class="selected_images">
              <div class="main-image product-image">
                <?= $photos ? '<img src="' . $photos[0] . '" alt="Product Cover Image">' : '' ?>
              </div>
              <div class="sub_images">
                <div class="sub_images_container">
                  <?php
                  if ($photos)
                    foreach ($photos as $photo) {
                      echo '<div class="sub-image product-image">
                                <img src="' . $photo . '" alt="Product photo">
                              </div>';
                    }
                  ?>
                </div>
              </div>
              <div class="action">
                <button type="button" id="change-images" class="btn btn-s">Change/Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Info -->
      <div class="flex gap-1 top start form-sections">
        <div class="form-section">
          <div class="head">
            <h3>Product info</h3>
            <input type="hidden" name="product_id" id="product_id" value="<?= $id ?>" />
            <input type="hidden" name="update_files" id="update_files" />
          </div>
          <div class="body">
            <div class="input-group">
              <label for="name">Car name</label>
              <input type="text" name="name" id="name" placeholder="Car name" required value="<?= $name ?>" />
            </div>

            <div class="input-group">
              <label for="description">Description</label>
              <textarea name="description" id="description" placeholder="About this product" required><?= $description ?></textarea>
            </div>

            <div class="input-group">
              <label for="features">Features</label>
              <input type="text" id="features" name="features" placeholder="Enter product features" required value="<?= $features ?>" />
              <small class="clr-warning">Seperate with comma ,</small>
            </div>
          </div>
        </div>

        <div class="form-section">
          <div class="head">
            <h3>More info</h3>
          </div>
          <div class="body">
            <div class="input-group">
              <label for="brand">Brand/Model</label>
              <!-- CUSTOM SELECT -->
              <div class="custom_select">
                <div class="select_btn flex between input">
                  <span class="label"><?= $brandTitle ?: 'Select Brand' ?></span>
                  <input type="hidden" class="selected_info" name="brand" value="<?= $brandID ?>" />
                  <i class="fas fa-caret-down"></i>
                </div>
                <p class="txt-right mt-x w-full" style="height:0">
                  <small>
                    <a href="/dashboard/create-product.php?form=brand">Add a Brand</a>
                  </small>
                </p>

                <div class="data_container">
                  <div class="custome_select_overlay"></div>
                  <div class="select_content">
                    <div class="select_search">
                      <input type="search" class="search_input" placeholder="Search..." />
                      <i class="search_icon fas fa-search"></i>
                    </div>
                    <ul class="options">
                      <?php
                      foreach ($Brands as $option) {
                        // echo '<option value="'.$brand['id'].'">'.$brand['title'].'</option>';
                        echo '
                          <li class="list-option flex between false">
                            <span class="option_text" data-optionvalue="' . $option['brandID'] . '">' . $option['title'] . '</span>
                            <i class="option_icon fas fa-caret-left"></i>
                          </li>';
                      }
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="input-group">
              <label for="created_on">Create a date</label>
              <input type="date" name="created_on" id="created_on" value="<?= $created_on ?>" />
              <?php if ($created_on) : ?>
                <div class="txt-right">
                  <small><b>Current: </b><small class="clr-warning"><?= $created_on ?></small>
                </div>
              <?php endif; ?>
            </div>
            <div class="flex gap-2">
              <div class="input-group">
                <p class="flex between flex-1">
                  <label for="price">Price</label>
                  <small class="clr-warning">USD</small>
                </p>
                <input type="number" name="price" id="price" placeholder="Price" required value="<?= $price ?>" />
              </div>

              <div class="input-group flex-1">
                <label for="year">Year</label>

                <!-- CUSTOM SELECT -->
                <div class="custom_select">
                  <div class="select_btn flex between input">
                    <span class="label"><?= $yearTitle ?: 'Select a year' ?></span>
                    <input type="hidden" class="selected_info" name="year" value='<?= $yearID ?>' />
                    <i class="fas fa-caret-down ml-2"></i>
                  </div>
                  <p class="txt-right mt-x w-full" style="height:0">
                    <small>
                      <a href="/dashboard/create-product.php?form=car-year">Add a year</a>
                    </small>
                  </p>

                  <div class="data_container">
                    <div class="custome_select_overlay"></div>
                    <div class="select_content">
                      <div class="select_search">
                        <input type="search" class="search_input" placeholder="Search..." />
                        <i class="search_icon fas fa-search"></i>
                      </div>
                      <ul class="options">
                        <?php
                        foreach ($Years as $option) {
                          echo '
                            <li class="list-option flex between false">
                              <span class="option_text" data-optionvalue="' . $option['yearID'] . '">' . $option['title'] . '</span>
                              <i class="option_icon fas fa-caret-left"></i>
                            </li>';
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="actions flex mt-2 end gap-2">
        <a href="/dashboard/" class="btn btn-s">Cancel</a>
        <button class="btn btn-p" type="submit" name="create_product">
          <span class="mr-1"> Save </span>
        </button>
      </div>
    </form>
  </div>
</div>