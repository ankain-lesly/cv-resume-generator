
<?php
  $error = null;
  $brand = '';
  $id = '';

  include_once __DIR__.'/../../../connect/Controllers/BrandController.php';

  use App\Controllers\BrandController;
  use App\Config\CustomLibrary;

  // GET EDIT DATA
  if(isset($_GET['edit'])) {
    $Brand = (new BrandController())->show($_GET['edit']);

    if(!$Brand) 
      exit('<h4 class="clr-warning txt-center">Product Not Found</h4>');

    $id = $Brand['id'];
    $brand = $Brand['title'];
  }
  
  // SAVE PRODUCT DATA
  if(isset($_POST['create_brand'])) {
    if($_POST['brand_id']) {
      $Brand = (new BrandController())->update();

      if(isset($Brand['error'])) {
        $error = $Brand['error']['message'];
        $brand = $Brand['error']['data'];
      } else 
        CustomLibrary::setToast('Brand updated successfully 👍', '/dashboard/view-product.php?view=brands');

    }else {
      $Brand = (new BrandController())->create();

      if(isset($Brand['error'])) {
        $error = $Brand['error']['message'];
        $brand = $Brand['error']['data'];
      } else 
        CustomLibrary::setToast('Brand Created successfully 👍', '/dashboard/view-product.php?view=brands');
    }

  }

 ?>
<div class="dashboard-main">
  <header class="">
    <div class="container-x flex between">
      <a href="/dashboard/" class="btn btn-s">Back</a>
      <h4>Create Brand</h4>
    </div>
  </header>
  <div class="form-container container-x">
    <nav class="">
      <h3 class="clr-success mb-1">Products Brand</h3>
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
        placeholder="Enter a Brand title"
        autocomplete="off"
        autocapitalize="on"
        value="<?= $brand?>"
        required
      />
    </div>
    <form method="post" action="" >
      <!-- Product Image -->
      <div class="form-section">
        <div class="head">
          <h3>Basic info</h3>
          <input type="hidden" name="brand_id" value="<?= $id?>">
        </div>
        <div class="body">
          
        <div class="input-group">
              <label for="brand_title">Brand title</label>
              <input
                type="text"
                name="brand_title"
                id="name"
                placeholder="Title"
                required
                value="<?= $brand?>"
              />
            </div>

        </div>
      </div>

      <div class="actions flex mt-2 end gap-2">
        <a href="/dashboard/" class="btn btn-s">Cancel</a>
        <button class="btn btn-p" type="submit" name="create_brand">
          <span class="mr-1"> Save </span>
        </button>
      </div>
    </form>
  </div>
</div>