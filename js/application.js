// グローバル変数
var gl_chk = [];
var gl_sub = [];
var Nogl_chk = [];
var Nogl_sub = [];

$(function() {

  // 削除チェックボックスの監視
  // 完了タスク
  var chk = [];
  var sub = [];
  var classCount = $('.chk').length
  for (var i = 0 ; i < classCount ; i++)
  {
    chk.push("#chk_" + i);
    sub.push("#sub_" + i);
    $(sub[i]).attr('disabled', 'disabled');
  }

  gl_chk = chk;
  gl_sub = sub;

  // 未完了タスク
  var Nochk = [];
  var Nosub = [];
  var NoclassCount = $('.nochk').length
  for (var i = 0 ; i < NoclassCount ; i++)
  {
    Nochk.push("#nochk_" + i);
    Nosub.push("#nosub_" + i);
    $(Nosub[i]).attr('disabled', 'disabled');
  }

  Nogl_chk = Nochk;
  Nogl_sub = Nosub;

  // 指定行クリックによるリンク
  $('tr[data-href]').addClass('clickable')
    .click(function(e) {
      if($(e.target).is('td,th')){    // 違うタグが入ることでリンクを飛ばさないように設定
        window.location = $(e.target).closest('tr').data('href');
      };
  });

  // ブラウザに関係なくカレンダー表示
  $("#datepicker").datepicker();

});

// ページ内リンクスムーズ移動
$(function(){
	$('a[href^=#]').click(function(){
		var speed = 900;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("html, body").animate({scrollTop:position}, speed, "swing");
		return false;
	});
});

// 完了にチェックをすることでの操作
function chkClick_b() {
　if (finishform_b.finish_b.checked) {
　　location.href="test.html";
　}
}

// 削除チェックボックスをクリックした時に呼び出される
function whichChk() {

  if ($('[class="chk"]:checked').prop('checked') == true) {
    chkbox = $('[class="chk"]:checked').attr('id');
    var strchk = chkbox.split('_');   // アンダーバーで分割
    var tr_chk = strchk[1];           // 変数に代入（なくてもいいけどわかりやすい）

    $(gl_chk[tr_chk]).change(function() {
      if ($(this).is(':checked')) {
        $(gl_sub[tr_chk]).removeAttr('disabled').focus();
      } else {
        $(gl_sub[tr_chk]).attr('disabled' , 'disabled');
      }
    });
  }

}

function NowhichChk() {

  if ($('[class="nochk"]:checked').prop('checked') == true) {
    Nochkbox = $('[class="nochk"]:checked').attr('id');
    var Nostrchk = Nochkbox.split('_');
    var Notr_chk = Nostrchk[1];

    $(Nogl_chk[Notr_chk]).change(function() {
      if ($(this).is(':checked')) {
        $(Nogl_sub[Notr_chk]).removeAttr('disabled').focus();
      } else {
        $(Nogl_sub[Notr_chk]).attr('disabled' , 'disabled');
      }
    });
  }

}
