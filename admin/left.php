       <div id="middle">
            <div id="left-column">
         <?php if(CheckPermission('admin_product')){ ?>
                <h3>Sản phẩm</h3>
                <ul class="nav">
                    <li><a href="?page=add_product">Thêm sản phẩm</a></li>
                    <li><a href="?page=manage_product">Quản lý sản phẩm</a></li>
                    <li><a href="?page=manage_os">Quản lý hệ điều hành</a></li>
                    <li><a href="?page=manage_brand">Quản lý hãng sản xuất</a></li>
                </ul>
         <? } ?>
         <?php if(CheckPermission('admin_order')){ ?>
                <h3>Đơn hàng</h3>
                <ul class="nav">
                    <li><a href="?page=manage_order">Quản lý đơn hàng</a></li>
                </ul>
         <? } ?>
         <?php if(CheckPermission('admin_news')){ ?>
		     <h3>Tin tức</h3>
                <ul class="nav">
                    <li><a href="?page=add_news">Thêm tin tức</a></li>
                    <li><a href="?page=manage_news">Quản lý tin tức</a></li>
                </ul>
         <? } ?>
         <?php if(CheckPermission('admin_feedback')){ ?>
                <h3>Góp ý của khách hàng </h3>
                <ul class="nav">
                  <li><a href="?page=manage_feedback">Xem góp ý khách hàng</a>
                </ul>
         <? } ?>
            </div>
            <div id="center-column">
