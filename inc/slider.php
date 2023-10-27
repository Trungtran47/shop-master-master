<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php 
            $getLastestIphone = $product->getLastestIphone();
            if($getLastestIphone){
                while($resultIphone = $getLastestIphone->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="preview.php?proid=<?php echo $resultIphone['productId'] ?>"> <img src="admin/uploads/<?php echo $resultIphone['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Iphone</h2>
                    <p><?php echo $resultIphone['productName']?>"</p>
                    <div class="button"><span><a href="preview.php?proid=<?php echo $resultIphone['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                }
            }
            ?>
             <?php 
            $getLastestSs = $product->getLastestSamsung();
            if($getLastestSs){
                while($resultSs = $getLastestSs->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="preview.php?proid=<?php echo $resultSs['productId'] ?>"> <img src="admin/uploads/<?php echo $resultSs['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Samsung</h2>
                    <p><?php echo $resultSs['productName']?>"</p>
                    <div class="button"><span><a href="preview.php?proid=<?php echo $resultSs['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="section group">
        <?php 
            $getLastestOp = $product->getLastestOppo();
            if($getLastestOp){
                while($resultOp = $getLastestOp->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="preview.php?proid=<?php echo $resultOp['productId'] ?>"> <img src="admin/uploads/<?php echo $resultOp['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Oppo</h2>
                    <p><?php echo $resultOp['productName']?>"</p>
                    <div class="button"><span><a href="preview.php?proid=<?php echo $resultOp['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                }
            }
            ?>
             <?php 
            $getLastestVv = $product->getLastestVivo();
            if($getLastestVv){
                while($resultVv = $getLastestVv->fetch_assoc()){
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="preview.php?proid=<?php echo $resultVv['productId'] ?>"> <img src="admin/uploads/<?php echo $resultVv['image']?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Vivo</h2>
                    <p><?php echo $resultVv['productName']?>"</p>
                    <div class="button"><span><a href="preview.php?proid=<?php echo $resultVv['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>    
    
    <div class="header_bottom_right_images">
            <!-- FlexSlider -->
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                    <?php
                    $sllist = $product-> show_slider_page();
                    if($sllist){
                        while($result = $sllist -> fetch_assoc()){		
                    ?>
                        <li><img src="admin/uploads/<?php echo $result['sliderImage'] ?>" alt="<?php echo $result['sliderName'] ?>" /></li>
                        <?php
        }}
        ?>
                    </ul>
                </div>
            </section>
            <!-- FlexSlider -->
    </div>
    
    <div class="clear"></div>
</div>