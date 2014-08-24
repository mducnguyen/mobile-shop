<?php
if(!isset($_GET['item']) || $_GET['item'] == NULL)
  $item_per_page = 10;
else
  $item_per_page = $_GET['item'];
$data = Paging('Product',$item_per_page);
?>
<div class="top-bar">
                    <h1>Quản lý sản phẩm</h1>
</div>
<div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th colspan="5" class="full">Danh sách sản phẩm | Hiển thị: 
                            <select name="item_per_page" onchange="<?echo $data['js_itemperpage'];?>">
                              <?php
                                $list = array(10,20,30,50,100);
                                foreach($list as $value){
                                  if($value == $item_per_page)
                                    echo "<option value=\"$value\" selected=\"selected\">$value</option>";
                                  else
                                    echo "<option value=\"$value\">$value</option>";
                                }
                              ?>
                            </select>
                            </th>
                            <tr>
                              <th>Hình ảnh đại diện</th>
                              <th>Thông tin sản phẩm</th>
                              <th>Giá (VNĐ)</th>
                              <th colspan="2"></th>
                            </tr>
                        </tr>
                        <?php while($row = mysql_fetch_array($data['result'])){ ?>
                        <tr>
                            <td class="thumb"><img src="<?echo $row['THUMBNAIL']?>" width="100" height="100"/></td>
                            <td style="text-align:left; width:300px;">
                            <span style="font-weight:bold;"><?echo $row['NAME']?></span><br />
                            <?echo $row['DESCRIPTION'];?>
                            
                            </td>
                            <td><?echo number_format($row['PRICE']);?></td>
                            <td class="btn"><a href="?page=update_product&id=<?echo $row['ID']?>"><img src="img/edit-icon.gif" width="16" height="16" alt="" /></td>
                            <td class="btn"><a href="#" onclick="confirm_delete('product',<?echo $row['ID']; ?>)"><img src="img/hr.gif" width="16" height="16" alt="Delete" /></a></td>
                        </tr>
 <? } ?>
                        <tr>
                        <th colspan="4" style="text-align:right">
                        <form onsubmit="<?echo $data['js_pagejump'];?>">
                        <?echo $data['backbtn']." ".$data['nextbtn']; ?>
                        <strong>Jump to page: </strong>
                        <input type="text" size="1" id="pagejump" value="<?echo $data['currentpage'];?>" />
                        /<span class="style1"><?echo $data['pagenum'];?></span>
                        <input type="submit" value="Go"> 
                       </form> 
                        </th>
                      </tr>
                    </table>
                </div>
