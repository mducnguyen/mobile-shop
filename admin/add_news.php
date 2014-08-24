<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<div class="top-bar">
                    <h1>Thêm tin tức</h1>
</div>
<br />
<form name="add_admin" action="?page=news_query&action=add" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th>
      Tiêu đề: <input name="TITLE" type="text" size="50" />
    </th>
  </tr>
   <tr>
    <th>
      <b>Miêu tả: <input name="DESCRIPTION" type="text" size="50" /></b>
    </th>
  </tr>
   <tr>
    <td>
      <b>Tin quan trọng: <input name="IMPORTANT" type="checkbox" value="1" /></b>
    </td>
  </tr>
  <tr>
    <td><textarea class="ckeditor" name="CONTENT" onKeyUp=""></textarea></td>
  </tr>
      <tr>
    <td>
      <p style="font-weight: bold">Ảnh đại diện: <input name="THUMBNAIL" type="text" size="50" /></p>
    </td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  
  </table>
  <div id="news_preview">
  </div>
</div>
</form>

