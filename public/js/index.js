$(function() {
  var home = $('#home'), mMenu = $('#m-menu'), isOpen = false;
  home.click(function() {
    isOpen ? mMenu.removeClass('open').hide() : mMenu.show(100, function() {
      mMenu.addClass('open')
    });
    isOpen = !isOpen;
  })

  mMenu.find('.m-menu').click(function(e) {
    e.stopPropagation();
  })
  mMenu.find('a').click(hide)
  mMenu.click(hide)

  function hide() {
    mMenu.removeClass('open').hide()
    isOpen = false
  }
  window.scrollReveal = new scrollReveal({reset: true});

})

$(function() {
	var e = $("#rocket-to-top"), t = $(document).scrollTop(),
  n,r,i = !0;
  // if($(window).width() <= 750) return;
	$(window).scroll(function() {
		var t = $(document).scrollTop();
		t == 0 ? e.css("background-position") == "0px 0px" ? e.fadeOut("slow") : i && (i = !1, $(".level-2").css("opacity", 1), e.delay(100).animate({
			marginTop: "-1000px"
		},
		"normal",
		function() {
			e.css({
				"margin-top": "-125px",
				display: "none"
			}),
			i = !0
		})) : e.fadeIn("slow")
	}),
	e.hover(function() {
		$(".level-2").stop(!0).animate({
			opacity: 1
		})
	},
	function() {
		$(".level-2").stop(!0).animate({
			opacity: 0
		})
	}),
	$(".level-3").click(function() {
		function t() {
			var t = e.css("background-position");
			if (e.css("display") == "none" || i == 0) {
				clearInterval(n),
				e.css("background-position", "0px 0px");
				return
			}
			switch (t){
			case "0px 0px":
				e.css("background-position", "-298px 0px");
				break;
			case "-298px 0px":
				e.css("background-position", "-447px 0px");
				break;
			case "-447px 0px":
				e.css("background-position", "-596px 0px");
				break;
			case "-596px 0px":
				e.css("background-position", "-745px 0px");
				break;
			case "-745px 0px":
				e.css("background-position", "-298px 0px");
			}
		}
		if (!i) return;
		n = setInterval(t, 50),
		$("html,body").animate({scrollTop: 0},"slow");
	});
});


$(function() {
	var $loginForm = $('#login-form'), $user = $('#user'), $pass = $('#pass'), $loginBtn = $loginForm.find('.login-btn');

	$loginBtn.click(function() {
		var user = $user.val(), pass = $pass.val();
		if(check(user, pass)) $loginForm.submit();
	});
	function check(user, pass) {
		if(!user || typeof user !== 'string' || !pass || typeof pass !== 'string') {
			alert('用户名或密码格式不正确')
      return false
		}
    var userReg = /^[0-9a-zA-Z-_.@]{4,50}$/
    var passReg = /^[0-9a-zA-Z-_.]{6,50}$/
    if(!userReg.test(user.trim()) ||
      !passReg.test(pass.trim())) {
      alert('用户名或密码格式不正确')
      return false
    }
    return true
  }
});