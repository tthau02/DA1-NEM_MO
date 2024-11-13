<?php include 'views/components/sidebar.php'; ?>
<div class="main">
    <?php include "views/components/header.php" ?>
    <!--danh sach sản phẩm-->
    <main class="container-fluid content px-3 py-4">
        <div class="shadow bg-white pb-5 mt-4 ms-4 mb-4 col-md-11" style="width: 96%;">
            <div>
                <h4 class="p-3">Cập nhật sản phẩm</h4>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <form action="" class="ms-4">
                    <div class="input-group input-group-sm">
                        <input class="form-control rounded-0 mb-2 pb-2" type="search" id="search" name="search" placeholder="Nhập từ khóa tìm kiếm" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <div class="input-group-sm">
                            <button type="button" class="btn btn-secondary rounded-0">
                                <i class="lni lni-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <form class="pb-5 mt-4 ms-4 mb-4 col-md-11" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Tên sản phẩm</label>
                    <input type="text" class="form-control mt-2 mb-3" value="<?= $product->product_name ?>" name="productName" required>
                </div>
                <div class="form-group">
                    <label for="productImage">Hình ảnh</label>
                    <input type="file" class="form-control mt-2 mb-3" value="<?= $product->product_image ?>" name="productImage">
                </div>
                <div class="form-group">
                    <label for="">Giá</label>
                    <input type="number" class="form-control mt-2 mb-3" value="<?= $product->product_price ?>" name="product_price">
                </div>

                <div class="form-group">
                    <label for="productDesc">Mô tả</label>
                    <input type="text" class="form-control mt-2 mb-3" value="<?= $product->product_description ?>" name="productDesc">
                </div>



                <div class="form-group mb-3">
                    <span class="form-label">Mã danh mục</span>
                    <select name="categorie_id"  id="">
                        <option value=""><?= $product->categorie_id ?></option>
                        <!-- <?php
                        foreach ($categoryList as $cate) { ?>
                            
                            <option value='<?=$cate->categorie_id?>' ><?= $cate->categorie_name ?></option>;
                       <?php }
                        ?> -->
                    </select>
                </div>



                <button type="submit" class="btn btn-info text-light" name="submitFormUpdateProduct">Cập nhật</button>
                <button type="reset" class="btn btn-secondary text-light">Nhập lại</button>
                <a href="?act=list-product" class="btn btn-info text-light">Danh sách</a>

                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?= htmlspecialchars($successMessage); ?>
                    </div>
                <?php elseif (isset($errorMessage)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?= htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>
            </form>

        </div>

</div>
</main>
<!--end-->
</div>

<?php include "views/components/footer.php" ?>