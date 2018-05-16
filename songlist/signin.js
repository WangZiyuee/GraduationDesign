$(document).ready(function() {
  var songlist = new Array();
  $('#like-icon').hide();
  $('#back-icon').click(function() {
    window.history.back(-1);
  });
  $("#next-icon").click(function(event) {
    $.ajax({
        url: '/path/to/file',
        type: 'default GET (Other values: POST)',
        dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {
          param1: 'value1'
        }
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

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
          songlist.push(songId);
          // songlist.push(songId);
          $("#list").append('<a id="' + songId + '" href="javascript:void(0)" class="list-group-item">' +
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
    $.ajax({
        url: '/path/to/file',
        type: 'default GET (Other values: POST)',
        dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {
          param1: 'value1'
        }
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

    $(this).css("background-image", "url('image/likefull-icon.png')");
    console.log(userid);
    //改变songid标签的歌曲背景颜色
    console.log($('#like-icon').attr('song-id'));
    //这里执行喜欢歌曲的插入
  });

});
