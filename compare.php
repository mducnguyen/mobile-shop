<script type="text/javascript">
  $(document).ready(function(){
      $('#searchbox1').autocomplete("phone_search.php?action=search", {
          width: 200,
          matchContains: true,
          selectFirst: false
        });
        
      $('#searchbox2').autocomplete("phone_search.php?action=search", {
          width: 200,
          matchContains: true,
          selectFirst: false
        });
      });
</script>

<table id="phone_search">
  <tr>
    <th>Sản phẩm 1</th>
    <th>Sản phẩm 2</th>
  </tr>
  <tr>
    <td>
        <center>
          <input type="text" name="query" id="searchbox1" size="20" />
          <input type="button" name="btnShow1" id="btnShow1" value="Show" onclick="show_product(1)"/>
        </center>
    </td>
    <td>
        <center>
          <input type="text" name="query" id="searchbox2" size="20" />
          <input type="button" name="btnShow2" id="btnShow2" value="Show" onclick="show_product(2)"/>
        </center>
    </td>
  </tr>
</table>
<br />
<div id="products">  
<? maketable();?>
</div>
