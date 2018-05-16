$("#signin-button").click(function() {
  $("#login-content").hide(300);
  $("#signin-content").show(500);
  $("#signin-username").val($("#login-username").val());
  $("#signin-fpassword").focus();
  if ($("#signin-username").val().length != 0) {
    $("#signin-name-check").removeClass("glyphicon glyphicon-remove").addClass('glyphicon glyphicon-ok');
  } else {
    $("#signin-name-check").removeClass("glyphicon glyphicon-ok").addClass('glyphicon glyphicon-remove');
  }
});
$("#signin-back-button").click(function() {
  $("#login-content").show(300);
  $("#signin-content").hide(500);
});


$("#signin-fpassword").bind("input propertychange", function() {
  if ($("#signin-fpassword").val().length >= 6) {
    $("#password-fcheck").removeClass("glyphicon glyphicon-remove").addClass('glyphicon glyphicon-ok');
  } else {
    $("#password-fcheck").removeClass("glyphicon glyphicon-ok").addClass('glyphicon glyphicon-remove');
  }
});
$("#signin-spassword").bind("input propertychange", function() {
  /* Act on the event */
  if ($("#signin-fpassword").val() == $(this).val() && $("#signin-fpassword").val().length != 0) {
    $("#password-scheck").removeClass("glyphicon glyphicon-remove").addClass('glyphicon glyphicon-ok');
  } else {
    $("#password-scheck").removeClass("glyphicon glyphicon-ok").addClass('glyphicon glyphicon-remove');
  }
});


$("#signin-btn").click(function() {
  if ($("#signin-username").val() != "" && $("#signin-fpassword").val().length >= 6 && $("#signin-fpassword").val() == $("#signin-spassword").val()) {
    $.ajax({
      type: "POST",
      url: "Api/user/userSignin.php",
      dataType: "json",
      data: {
        userName: $("#signin-username").val(),
        userPassword: $("#signin-fpassword").val()
      },
      success: function(data) {
        if (data == 302) {
          alert("用户名重复");
        } else {
          var userId = data;
          window.location.href = 'user/index.html?userId=' + userId;
        }
      },
      error: function() {
        alert("注册失败");
      }
    });
  } else {
    alert("格式错误");
  }
});

// 用户登陆
$("#login-btn").click(function() {
  if ($("#login-username").val() != "" && $("#login-userpassword").val().length >= 6) {
    $.ajax({
      type: "POST",
      url: "Api/user/userLogin.php",
      dataType: "json",
      data: {
        userName: $("#login-username").val(),
        userPassword: $("#login-userpassword").val()
      },
      success: function(data) {
        if (data == 501) {
          alert("密码错误或者账户不存在");
        } else {
          var userId = data;
          window.location.href = 'Main/index.html?userId=' + userId;
        }
      },
      error: function() {
        alert("数据库连接失败");
      }
    });
  } else {
    alert("格式错误");
  }
});
