            </div>
   <div id="right-column">
         <?php if(CheckPermission('admin_admin')){ ?>
	         <h3>Quản trị viên</h3>
                <ul class="nav">
                    <li><a href="?page=add_admin">Thêm quản trị viên</a></li>
                    <li><a href="?page=manage_admin">Quản lý quản trị viên</a></li>
                    <li><a href="?page=manage_admingroup">Nhóm quản trị viên</a></li>
                </ul>
         <? } ?>
         <?php if(CheckPermission('admin_customer')){ ?>
                <h3>Khách hàng</h3>
                <ul class="nav">
                    <li><a href="?page=add_customer">Thêm khách hàng</a></li>
                    <li><a href="?page=manage_customer">Quản lý khách hàng</a></li>
                </ul>
         <? } ?>
         <?php if(CheckPermission('admin_system')){ ?>
                <h3>Cài đặt</h3>
                <ul class="nav">
                    <li><a href="#">Chỉnh sửa cài đặt hệ thống</a></li>
                </ul>
         <? } ?>
                </ul>
            </div>
