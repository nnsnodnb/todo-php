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
    <title>ToDo管理</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/application.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/application.js"></script>
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
              <li class="active"><a href="index.php">タスク一覧</a></li>
              <li><a href="task-add.php">タスク登録</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="row">

        <div class="col-sm-12">
          <h1>タスク一覧</h1>
          <a href="task-add.php">
            <button type="button" class="btn btn-info" style="margin-top: 23px;"><i class="fa fa-pencil"></i> 登録</button>
          </a>
        </div>

        <div class="col-sm-12" style="margin-top: 30px;">
          <legend>完了タスク</legend>

            <?php

            $finish_task = 'SELECT * FROM task WHERE FINISH_CHECK = 1 ORDER BY FINISH_DATE DESC';
            $finish_stmt = $dbh->query($finish_task);
            $count = $finish_stmt -> rowCount();

            if ($count != 0)
            {
              echo "<table class='table table-striped table-bordered table-hover'>";
                echo "<tr align='center'>";
                  echo "<th>タイトル</th>";
                  echo "<th>予定日</th>";
                  echo "<th>完了日</th>";
                  echo "<th>優先順位</th>";
                  echo "<th>削除</th>";
                echo "</tr>";

                for ($i = 0 ; $i < $count ; $i++)
                {
                  $finish_result = $finish_stmt->fetch(PDO::FETCH_ASSOC);
                  $_SESSION['id'] = $finish_result['ID'];
                  $_SESSION['title'] = $finish_result['TITLE'];
                  $_SESSION['schedule'] = $finish_result['SCHEDULE_DATE'];
                  $_SESSION['finish'] = $finish_result['FINISH_DATE'];
                  $_SESSION['rank'] = $finish_result['RANK'];

                  echo "<tr class='finish' data-href='view.php'>";
                    echo "<td>".$finish_result['TITLE']."</td>";
                    echo "<td>".$finish_result['SCHEDULE_DATE']."</td>";
                    echo "<td>".$finish_result['FINISH_DATE']."</td>";
                    echo "<td>".$finish_result['RANK']."</td>";

                    echo "<td align='center'>";
                      echo "<form action='dbphp/delete.php' method='POST'>";
                        echo "<input type='checkbox' class='chk' value='0' id='chk_".$i."' onClick='whichChk()'>&nbsp;";
                        echo "<input type='hidden' name='delete-key' value='".$finish_result['ID']."'>";
                        echo "<input type='submit' class='btn btn-danger btn-xs' value='削除' id='sub_".$i."' onClick='return confirm(\"本当に削除しますか？\");'>";
                      echo "</form>";
                    echo "</td>";

                  echo "</tr>";

                }
              echo "</table>";
            }
            else
            {
              echo "<div class='well' align='center'>";
                echo "<h1>完了タスクがありません</h1>";
              echo "</div>";
            }

            ?>
        </div>

        <div class="col-sm-12">
          <legend>未完了タスク</legend>

            <?php

            $no_finish_task = 'SELECT * FROM task WHERE FINISH_CHECK = 0 ORDER BY schedule_date';
            $no_finish_stmt = $dbh->query($no_finish_task);
            $nfs_count = $no_finish_stmt -> rowCount();

            if ($nfs_count != 0)
            {
              echo "<table class='table table-striped table-bordered table-hover'>";
                echo "<tr>";
                  echo "<th>タイトル</th>";
                  echo "<th>予定日</th>";
                  echo "<th>優先順位</th>";
                  echo "<th>完了</th>";
                  echo "<th>削除</th>";
                echo "</tr>";
                for ($j = 0 ; $j < $nfs_count ; $j++)
                {
                  $no_finish_result = $no_finish_stmt->fetch(PDO::FETCH_ASSOC);

                  $_SESSION['notitle'] = $no_finish_result['TITLE'];
                  $_SESSION['noschedule'] = $no_finish_result['SCHEDULE_DATE'];
                  $_SESSION['norank'] = $no_finish_result['RANK'];
                  $_SESSION['noid'] = $no_finish_result['ID'];

                  echo "<tr class='no-finish' data-href='edit.php'>";
                    echo "<td>".$no_finish_result['TITLE']."</td>";
                    echo "<td>".$no_finish_result['SCHEDULE_DATE']."</td>";
                    echo "<td>".$no_finish_result['RANK']."</td>";
                    echo "<td align='center'>";
                      echo "<form action='index.php' name='finishform_b' method='POST'>";
                        echo "<input type='checkbox' name='finish_b' value='0' onClick='chkClick_b()'>";
                      echo "</form>";
                    echo "</td>";
                    echo "<td align='center'>";
                      echo "<form action='dbphp/delete.php' method='POST'>";
                        echo "<input type='checkbox' class='nochk' value='0' id='nochk_".$j."' onClick='NowhichChk()'>&nbsp;";
                        echo "<input type='hidden' name='delete-key' value='".$no_finish_result['ID']."'>";
                        echo "<input type='submit' class='btn btn-danger btn-xs' value='削除' id='nosub_".$j."' onClick='return confirm(\"本当に削除しますか？\");'>";
                      echo "</form>";
                    echo "</td>";
                  echo "</tr>";
              }
              echo "</table>";
            }
            else
            {
              echo "<div class='well' align='center'>";
                echo "<h1>未完了タスクがありません</h1>";
              echo "</div>";
            }

            ?>

        </div>

      </div>
    </div>

  </body>
</html>

<?php

$dbh = null;

?>
