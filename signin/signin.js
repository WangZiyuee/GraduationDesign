$(document).ready(function() {
  $('#back-icon').click(function() {
    window.history.back(-1);
  });
  var result = window.location.search.match(new RegExp("[\?\&]" + "userid" + "=([^\&]+)", "i"));
  console.log(result[1]);
  var userid = result[1];


  $("#submit").click(function() {
    var tags = [];
    $("input[name='check']:checked").each(function(i) {
      tags[i] = $(this).val();
    });
    console.log(tags);
    $.ajax({
      type: "POST",
      url: "../Api/user/.php",
      dataType: "json",
      data: {
        tags: tags
      },
      success: function(data) {
        
      },
      error: function() {

      },
      complete: function() {

      }
    });
  });

  $('#like-icon').click(function() {
    $(this).css("background-image", "url('image/likefull-icon.png')");
    console.log(userid);
    //改变songid标签的歌曲背景颜色
    console.log($('#like-icon').attr('song-id'));
    //这里执行喜欢歌曲的插入
  });

});
