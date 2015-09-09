// 指定行クリックによるリンク
jQuery(function($) {
  $('tr[data-href]').addClass('clickable')
    .click(function(e) {
      if($(e.target).is('td,th')){
        window.location = $(e.target).closest('tr').data('href');
      };
  });
});

// チェックボックスによる削除ボタンの有効化
$(function() {
  $('#finish-submit').attr('disabled', 'disabled');
	$('#delete-submit').attr('disabled', 'disabled');
  $('#no-finish-submit').attr('disabled', 'disabled');
	$('#no-delete-submit').attr('disabled', 'disabled');

  // 完了タスク
	$('#check-finish').click(function() {
		if ($(this).prop('checked') == false) {
			$('#finish-submit').attr('disabled', 'disabled');
		} else {
			$('#finish-submit').removeAttr('disabled');
		}
	});
	$('#check-delete').click(function() {
		if ($(this).prop('checked') == false) {
			$('#delete-submit').attr('disabled', 'disabled');
		} else {
			$('#delete-submit').removeAttr('disabled');
		}
	});

  // 未完了タスク
  $('#no-check-finish').click(function() {
		if ($(this).prop('checked') == false) {
			$('#no-finish-submit').attr('disabled', 'disabled');
		} else {
			$('#no-finish-submit').removeAttr('disabled');
		}
	});
	$('#no-check-delete').click(function() {
		if ($(this).prop('checked') == false) {
			$('#no-delete-submit').attr('disabled', 'disabled');
		} else {
			$('#no-delete-submit').removeAttr('disabled');
		}
	});
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

// 完了のチェック解除をすることでの操作
function chkClick() {
　if (!finishform.finish.checked) {
　　location.href="test.html";
　}
}

// 完了にチェックをすることでの操作
function chkClick_b() {
　if (finishform_b.finish_b.checked) {
　　location.href="test.html";
　}
}

// jQueryでどのブラウザにもカレンダー表示を対応
$(function() {
  $("#datepicker").datepicker();
});
