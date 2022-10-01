$(".open").click(function () {
  $("#a").css("display", "block");
  $("#b").css("display", "block");
});

$(".cancel").click(function () {
  $("#a").fadeOut();
  $("#b").fadeOut();
});
