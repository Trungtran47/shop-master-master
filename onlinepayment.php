<?php
include 'inc/header.php';
?>


    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="content_top">
                    <div class="heading">
                        <h3>Online Payment Method</h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <h3>Chọn cổng thanh toán</h3>
               <form action="congthanhtoan.php" method="post">
                <button name="redirect" id="redirect">
                    VNPay online
                </button>
            </form>
                
            </div>
        </div>
    </div>

<?php
include 'inc/footer.php';
?>