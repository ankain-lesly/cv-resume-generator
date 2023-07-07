<?php
include_once '../connect/Controllers/CategoryController.php';

use App\Models\DataAccess;

$DataAccess = new DataAccess();
$categories = $catObj->index();

$carSQL =  "SELECT * FROM tblcars WHERE actions = 'TRASHED'";
$cars = $DataAccess->fetchAll($carSQL);
$categories = null;
?>
<div>
  <div class='header mb-2'>
    <p class="clr-warning mb-2">Item will be automatically deleted after 7Days</p>
    <h2 class="mb-x">My Trash</h2>
    <small>Trash Collection</small>
  </div>

  <div class='header flex between gap-2 mb-2 mt-4'>
    <h3>Trash Cars</h3>
    <a href="#">Cars</a>
  </div>

  <div class='container'>
    <div class='table-container custom-table-responsive'>
      <table class='table custom-table'>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Picture</th>
            <th scope='col'>Name</th>
            <th scope='col'>Brand</th>
            <th scope='col'>Year</th>
            <th scope='col'>Price</th>
            <th scope='col'>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($cars) {
            foreach ($cars as $car) {
              $photos = json_decode($car['photos'], true);
              $cover = $photos[0] ?? '/static/media/background.png';
          ?>
              <tr class='spacer'>
                <td colSpan='100'></td>
              </tr>
              <tr class=''>
                <td><i class="fas fa-caret-right"></i></td>
                <td>
                  <img src="<?= $cover ?>" alt="Car profile" class="table-image">
                </td>
                <td><?= $car['name'] ?></td>
                <td><?= $car['brandID'] ?></td>
                <td><?= $car['yearID'] ?></td>
                <td>$ <?= $car['price'] ?></td>
                <td>
                  <div class="actions flex gap-1 start">
                    <a href="/dashboard/create-product.php?form=car&edit=<?= $car['id'] ?>" class="btn padd" title="Restore Item">
                      <i class="fas fa-radiation"></i>
                    </a>
                    <a href="/dashboard/view-product.php?view=cars&trash=<?= $car['id'] ?>" class="btn padd" title="Click to Delete" onclick="return confirm('Do you want to DELETE this item!')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>

          <?php
            }
          } else {

            echo "<tr class='spacer'>
                  <td colSpan='100'>
                    <p class='error clr-danger txt-center pt-2 pb-2'>No Data Found</p>
                  </td>
                </tr>";
          }


          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class='header flex between gap-2 mb-2 mt-4'>
    <h3>Trash data</h3>
    <a href="#">Parts</a>
  </div>

  <div class='container'>
    <div class='table-container custom-table-responsive'>
      <table class='table custom-table'>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Title</th>
            <th scope='col'>Date</th>
            <th scope='col'>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class='spacer'>
            <td colSpan='100'>
              <p class='error clr-danger txt-center pt-2 pb-2'>No Data Found</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class='header flex between gap-2 mb-2 mt-4'>
    <h3>Trash data</h3>
    <a href="#">Others</a>
  </div>

  <div class='container'>
    <div class='table-container custom-table-responsive'>
      <table class='table custom-table'>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Title</th>
            <th scope='col'>Date</th>
            <th scope='col'>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class='spacer'>
            <td colSpan='100'>
              <p class='error clr-danger txt-center pt-2 pb-2'>No Data Found</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>