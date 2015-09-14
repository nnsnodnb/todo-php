$(function() {

  $(window).bind("load", function(){
    if(!document.URL.match("task-add") || !document.URL.match("edit") || !document.URL.match("view")) {

      // 初期表示時の処理
      $('.chk').each(function() {
        // 現在のチェック状態からボタンのdisabledを切り替える
        $('#sub_' + $(this).attr('data-id')).prop('disabled', !$(this).prop('checked'));
      });

      // チェックされた時の処理
      $('.chk').change(function() {
        // チェックボックスの「data-id」属性の値を頼りにボタンを特定
        var $sub = $('#sub_' + $(this).attr('data-id'));
        // ボタンのdisabled属性を反転
        $sub.prop('disabled', !$sub.prop('disabled'));
      });

      // 指定行クリックによるリンク
      $('tr[data-href]').addClass('clickable')
        .click(function(e) {
          if($(e.target).is('td,th')){    // 違うタグが入ることでリンクを飛ばさないように設定
            window.location = $(e.target).closest('tr').data('href');
          };
      });

      // ページ内リンクスムーズ移動
    	$('a[href^=#]').click(function(){
    		var speed = 700;
    		var href= $(this).attr("href");
    		var target = $(href == "#" || href == "" ? 'html' : href);
    		var position = target.offset().top;
    		$("html, body").animate({scrollTop:position}, speed, "swing");
    		return false;
    	});

    }
  });

  // ブラウザに関係なくカレンダー表示
  $(window).bind("load", function() {
    if(document.URL.match("task-add") || document.URL.match("view") || document.URL.match("edit")) {
      $("#datepicker").datepicker();
    }
  });

});

// 完了にチェックをすることでの操作
function chkClick_b() {
  if ($('[class="fini"]:checked').prop('checked') == true) {
    //location.href="dbphp/complete.php";
    link = $('[name="finishform_b"]').attr('action');
    location.href=link;
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

// タスク登録未入力チェック
function submit_chk() {
  var flag = 0 ;

  if (document.add.title_sub.value == "") {
    flag = 1 ;
  }
  if (document.add.scheduled.value == "") {
    flag = 1 ;
  }
  if (document.add.rank.value == "") {
    flag = 1 ;
  }

  if (flag == 1) {
    alert('必須項目に未入力がありました') ;
    return false;
  } else {
    return true;
  }
}
