$(function () {
  $('input[type=file]').change(function () {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (!file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('.imgfile').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function () {
      var img_src = $('<img>').attr('src', reader.result);
      $('.imgfile').html(img_src);
      $('.imgarea').removeClass('noimage');
    }
    reader.readAsDataURL(file);
  });

  $('.fav__btn').on('click', function () {
    var origin = location.origin;
    var $favbtn = $(this);
    var $productid = $favbtn.parent().parent().data('productid');
    var $myid = $('.prof-show').data('me');
    $.ajax({
      type: 'post',
      url: origin + '/original_appli/public_html/ajax.php',
      data: {
        'product_id': $productid,
        'user_id': $myid,
      },
      success: function (data) {
        if (data == 1) {
          $($favbtn).addClass('active');
        } else {
          $($favbtn).removeClass('active');
        }
      }
    });
    return false;
  });


});

$(document).ready(function() {
  $('#fav-table').tablesorter({
    headers: {
      0: {sorter: false},
      1: {sorter: false}
    }
  });
});

function Sort_onChange(){
  for (var i=0; i<document.f_page_size.sort.options.length; i++){
      if (document.f_page_size.sort.options[i].selected == true){
          document.f_search.i_sort.value = document.f_page_size.sort.options[i].value;
          break;
      }
  }
  document.f_search.submit();
}

function confirmDelete() {
  var res = confirm('退会します。\nよろしいですか？？');
  if(res === true) {
    document.getElementById('del_user').submit();
  }
}

function cartAllDelete() {
  var res = confirm('カートの中身を全て削除します。\nよろしいですか？？');
  if(res === true) {
    document.getElementById('cart_all_delete').submit();
  }
}

function reviewDelete() {
  var res = confirm('このレビューを削除します。\nよろしいですか？？');
  if(res === true) {
    document.getElementById('review_delete').submit();
  }
}

