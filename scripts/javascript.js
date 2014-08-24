function param_replace(param,value){
  var params = window.location.search;
  var pattern = new RegExp(param+"=\\w*");
  if(params.match(pattern))
    params = params.replace(pattern,param+'='+value);
  else
    params = params + "&" + param+'='+value;
  return params;
}

function confirm_delete(type, id){
  var link = '?page=delete&type='+type+'&id='+id;
  switch(type){
    case 'product':
      type = "sản phẩm";
      break;
    case 'admin':
      type = "quản trị viên";
      break;
    case 'admin_group':
      type = "nhóm";
      break;
    case 'comment':
      type = "nhận xét";
      break;
    case 'image':
      type = "ảnh";
      break;
    case 'news':
      type = "tin tức";
      break;
    case 'order':
      type = "đơn hàng";
      break;
    case 'os':
      type = "hệ điều hành";
      break;
    case 'brand':
      type = "hãng sản xuất";
      break;
    case 'customer':
      type = "khách hàng";
      break;
    case 'feedback':
      type = "góp ý";
      break;

  }
  var del = confirm("Bạn thực sự muốn xóa "+type+" này?");
  if (del == true)
    window.location.href = link;
  else return false;
}

function ImgReplace(image){
  image.setAttribute('src','./images/no_image.gif');
}

// Replace broken image with default image
$(document).ready(function(){
    $("img").each(function(){
        this.setAttribute('onError','ImgReplace(this)');
        if(this.getAttribute('src') == "")
          ImgReplace(this);
      });
    });

      
function show_product(id){
  var input = "searchbox"+id;
  var container = "products";
  var search_str = $("#"+input).val();
  var data = 'name='+search_str;
  if(search_str){
    $.ajax({
          type: "GET",
          url: "phone_search.php?action=set_phone&id="+id,
          data: data,
          beforeSend: function(){
          },
          success: function(html){
          }
        });
    $.ajax({
          type: "GET",
          url: "phone_search.php?action=show",
          data: data,
          beforeSend: function(){
          },
          success: function(html){
            $("#"+container).hide(300,function(){
              $("#"+container).html(html);
              $("#"+container).show(300);
            });
          }
        });
  }
  return false;
}

function show_order(orderid){
    $("#order"+orderid).toggle('500');
}
