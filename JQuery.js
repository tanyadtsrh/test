//Untuk memulai JQuery diawali dengan
$(document).ready(function () {});

//Kemudian berikut syntax lainnya
$(document).ready(function () {
  $("button").addClass("btn-primary"); //cara nambahin class ke semua element button tanpa looping
  $(".btn").addClass("btn-default");
  $(".btn").addClass("btn-primary btn-default"); //simplenya kayak gini bisa ditulis kayak class="c1 c2 c3 c..."
  //kiri adalah QuerySelector dan .function()

  $("#target1").removeClass("btn-default"); //menghapus class

  $("#target1").css("color", "red"); //cara ganti style property atau css menggunakan JQuery

  $("button").prop("disabled", true); //gunakan .prop() untuk mengubah property html

  $("#target4").html("<em>Target 4</em>"); //output = Target 4 | tapi miring
  $("#target4").text("<em>Target 4</em>"); //output = <em>Target 4</em>

  $("#target4").remove(); //untuk menghapus element html dari document

  $("#target2").appendTo("#right-div"); //memindahkan (button) element kiri ke dalam (div) element kanan
  $("#target5").clone().appendTo("#left-div"); //mencopy sekaligus menaruhnya kedalam (div)

  $("#target1").parent().css("background-color", "red"); // .parent() menargetkan parent dari element target
  //mengubah BG color dari parent element milik #target1
  $("#left-div").children().css("color", "orange"); //mengubah color semua child element dari left-div
  $("#left-div").children(".btn").css("color", "orange");
  //mengubah color semua child element dengan class btn dari left-div

  $(".btn:nth-child(2)").addClass("animated bounce"); //query di JQuery bisa seperti CSS selector
  $(".target:even").addClass("animated bounce"); //element genap dimulai dari 0 sebagai genap
});
