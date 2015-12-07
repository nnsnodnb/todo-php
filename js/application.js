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

        // 完了にチェックをすることでの操作
        $('.fini').change(function() {
            link = $(this).attr('data-finish');
            //console.log(data);
            location.href="dbphp/complete.php?id=" + link;
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
