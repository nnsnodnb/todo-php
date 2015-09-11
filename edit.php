<?php

require_once('config.php');

session_start();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>タスク変更・閲覧｜ToDo管理</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/application.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/application.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/excite-bike/jquery-ui.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="no-thank-yu">
    <header id="wrap">
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a href="index.php" class="navbar-brand">ToDo管理</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <li><a href="index.php">タスク一覧</a></li>
              <li><a href="task-add.php">タスク登録</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <p>
            <a href="javascript:history.back();">
              <button type="button" class="btn btn-default"><i class="fa fa-undo"></i> 戻る</button>
            </a>
          </p>
        </div>

        <div class="col-sm-8">
          <div class="well">
            <legend>タスク変更</legend>
            <form class="form-horizontal"  action="dbphp/no_update.php" method="POST">
              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">タイトル</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" id="title" value="<?php echo $_SESSION['notitle']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="scheduled" class="col-sm-2 control-label">予定日</label>
                <div class="col-sm-10">
                  <input type="text" id="datepicker" class="form-control" name="scheduled" id="scheduled" value="<?php echo $_SESSION['noschedule']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="rank" class="col-sm-2 control-label">優先順位</label>
                <div class="col-sm-10">
                  <select class="form-control" name="rank" id="rank">
                    <?php
                      $sql = 'SELECT RANK FROM task WHERE ID = '.$_SESSION['noid'];
                      $stmt = $dbh->query($sql);
                      $result = $stmt->fetch(PDO::FETCH_ASSOC);
                      if ($result['RANK'] == '高') {
                        echo "<option value='高' selected>高</option>";
                        echo "<option value='中'>中</option>";
                        echo "<option value='低'>低</option>";
                      } elseif ($result['RANK'] == '中') {
                        echo "<option value='高'>高</option>";
                        echo "<option value='中' selected>中</option>";
                        echo "<option value='低'>低</option>";
                      } elseif ($result['RANK'] == '低') {
                        echo "<option value='高'>高</option>";
                        echo "<option value='中'>中</option>";
                        echo "<option value='低' selected>低</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-submit">
                <div class="col-sm-10 col-sm-offset-2">
                  <a href="javascript:history.back();">
                    <button type="button" class="btn btn-info">戻る</button>
                  </a>
                  <input type="reset" class="btn btn-default" value="キャンセル">
                  <input type="submit" class="btn btn-primary" value="変更" onClick="return confirm('この内容で変更してもよろしいですか？')">
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-sm-4">
          <div class="well">
            <legend>タスク閲覧</legend>
            <?php
              echo "<h3>タイトル</h3>";
              echo "<p>".$_SESSION['notitle']."</p>";
              echo "<h3>予定日</h3>";
              echo "<p>".$_SESSION['noschedule']."</p>";
              echo "<h3>優先度</h3>";
              echo "<p>".$_SESSION['norank']."</p>";
            ?>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>

<?php

$dbh = null;

?>
