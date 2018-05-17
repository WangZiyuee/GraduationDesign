$(document).ready(function() {
  var songlist = new Array();

  $('#back-icon').click(function() {
    window.history.back(-1);
  });


  var result = window.location.search.match(new RegExp("[\?\&]" + "userid" + "=([^\&]+)", "i"));
  console.log(result[1]);
  var userid = result[1];

  $.ajax({
      url: '../Api/song/getUserLike.php',
      type: 'POST',
      dataType: 'json',
      data: {
        userId: userid
      }
    })
    .done(function(data) {
      console.log("success");
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
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
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
            },
            error: function() {
              console.log('error');
            },
            complete: function() {}
          });
        });
      }

    });

});
