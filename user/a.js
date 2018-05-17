$(document).ready(function() {
  var songlist = new Array();
  $('#like-icon').hide();
  $('#back-icon').click(function() {
    window.history.back(-1);
  });

  var result = window.location.search.match(new RegExp("[\?\&]" + "userid" + "=([^\&]+)", "i"));
  console.log(result[1]);
  var userid = result[1];



  $("#submit").click(function() {
    var tags = new Array();
    $("input[name='check']:checked").each(function(i) {
      tags[i] = $(this).val();
    });
    console.log(tags);
    console.log(tags.join(','));

    $.ajax({
      type: "POST",
      url: "../Api/song/getSongList.php",
      dataType: "json",
      data: {
        tags: tags.join(',')
      },
      success: function(data) {

        $("h3").text("推荐歌单");
        $("#choosebox").hide();
        $("#list").show();
        $('#like-icon').show();
        var item = data;
        for (var i = 0; i < item.length; i++) {

          var songId = item[i]['song_id'];
          var songName = item[i]['song_name'];
          var coverImgUrl = item[i]['coverimg_url'];
          var songTag = item[i]['song_tag'];
          songlist.push(songId);
          // songlist.push(songId);
          $("#list").append('<a id="' + songId + '" tag-code="' + songTag + '" href="javascript:void(0)" class="list-group-item">' +
            '<div class="media-left">' +
            '<img class="media-object" src="' + coverImgUrl + '" alt="...">' +
            '</div>' +
            '<div class="media-body">' +
            songName +
            '</div>' +
            '</a>');
        }
        console.log(data);

        const ap = new APlayer({
          container: document.getElementById('aplayer'),
          theme: '#ff6484',
          audio: [{
            name: 'name',
            artist: 'artist',
            url: '',
            cover: ''
          }]
        });
      },
      error: function(e) {
        console.log(111)
      },
      complete: function() {

        for (var j = 0; j < songlist.length; j++) {
          $('#' + songlist[j]).click(function(event) {
            var name = $(this).find(".media-body").text();
            var imgUrl = $(this).find("img").attr("src");
            var songID = $(this).attr("id");
            var songTag = $(this).attr("tag-code");
            $.ajax({
              type: "POST",
              url: "../Api/getSongUrl.php",
              dataType: "text",
              data: {
                songId: songID
              },
              success: function(data) {
                var songurl = data;
                const ap = new APlayer({
                  container: document.getElementById('aplayer'),
                  autoplay: true,
                  theme: '#ff6484',
                  // fixed: true,
                  audio: [{
                    name: name,
                    artist: 'V.A',
                    url: songurl,
                    cover: imgUrl
                  }]
                });
                $("#bgurl").css("background-image", 'url(' + imgUrl + ')');
                $('#like-icon').attr('song-id', songID);
                $('#like-icon').attr('tag-code', songTag);
              },
              error: function() {
                console.log('error');
              },
              complete: function() {

              }
            });
          });
        }
      }
    });
  });

  $('#like-icon').click(function() {
    // $(this).css("background-image", "url('image/likefull-icon.png')");

    var songId = $('#like-icon').attr('song-id');
    var tag = $('#like-icon').attr('tag-code');
    console.log($('#like-icon').attr('song-id') + ".songid");
    console.log($('#like-icon').attr('tag-code') + ".tagcode");
    $('#' + songId + '').css("background-color", '#ff6488');

    $.ajax({
        url: '../Api/song/addUserLike.php',
        type: 'POST',
        dataType: 'json',
        data: {
          songId: songId,
          userId: userid,
          tag: tag
        }
      })
      .done(function(data) {
        console.log("success:" + data);
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


    // console.log(userid);
    //改变songid标签的歌曲背景颜色

    //这里执行喜欢歌曲的插入
  });
  $("#next-icon").click(function() {
    window.location.href = '../like/like.html?userId=' + userid;
  });
});
