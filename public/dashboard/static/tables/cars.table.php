<?php 
    include_once '../connect/Controllers/CarController.php';
    use App\Controllers\CarController;
    use App\Config\CustomLibrary;
    use App\Models\DataAccess;

    $carObj = new CarController();
    $cars = $carObj->index();

    if(isset($_GET['trash'])) {
      $key = $_GET['trash'];
      // $carObj->delete($key);
      $DataAccess = new DataAccess();
      $sql = "UPDATE tblcars SET actions = 'TRASHED' WHERE id = :id";
      $status = $DataAccess->queryCustomData($sql, [$key]);
      
      if($status)
        CustomLibrary::setToast('Item Deleted.. ✔', '/dashboard/view-product.php?view=cars');
    }
?>

<div>
  <div class='header flex between mb-2'>
    <h2>My Cars</h2>
    <a href="./create-product.php?form=car" class='btn btn-p'>
      + New
    </a>
  </div>

  <div class='header flex between gap-2 mb-2'>
    <small>Table Options <div class="fas fa-angle-double-right"></div></small>
    <!-- <input type='text' placeholder='Search table' />
    <input type='text' placeholder='Table options' /> -->
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
          if($cars) {
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
            <td><?= $car['brand'] ?></td>
            <td><?= $car['year'] ?></td>
            <td>$ <?= $car['price']?></td>
            <td>
              <div class="actions flex gap-1 start">
                <a href="/dashboard/create-product.php?form=car&edit=<?= $car['id']?>" class="btn padd"
                  title="Click to Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="/dashboard/view-product.php?view=cars&trash=<?= $car['id']?>" class="btn padd"
                  title="Click to Delete" onclick="return confirm('Do you want to DELETE this item!')">
                  <i class="fas fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>

          <?php
            }
          }else {

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
</div>