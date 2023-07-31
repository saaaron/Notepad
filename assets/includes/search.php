<?php
  // start session
  session_start();

  // connect to database
  include 'db_connect.php';

  // format time function
  include "format-time-function.php";

  // variables
  $keyword = '';

  if (isset($_POST["query"])) {

    $id = $_SESSION['id']; // user's id

    // keyword
    $keyword = htmlentities($_POST["query"]);

    // notes
    $select_notes = "SELECT * FROM notes WHERE note LIKE CONCAT('%', ?, '%') AND by_user_id = ?";
    if ($stmt = mysqli_prepare($db, $select_notes)) {
      mysqli_stmt_bind_param($stmt, "si", $keyword, $id);
      mysqli_stmt_execute($stmt);
      while (mysqli_stmt_fetch($stmt)) {
        // fetch results
      }

      $total_notes = mysqli_stmt_num_rows($stmt);
    }


    $select_notes = "SELECT * FROM notes WHERE note LIKE CONCAT('%', ?, '%') AND by_user_id = ?";
    $stmt = mysqli_prepare($db, $select_notes);
    mysqli_stmt_bind_param($stmt, "si", $keyword, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      // fetch results
      $note_id = $row["note_id"]; // note id
      $note = strip_tags($row["note"]); // notes
      $favourite = $row["favourite"]; // favourite (marked)
      $created_on = $row["created_on"]; // time created

      if (strlen($note) > 43) {
        $note = mb_substr($note, 0, 43).'...';
      } else {
        $note = $note;
      }

      if ($favourite == "no") {
        // heart buton
        $notes_heart_button = '
        <div class="heart">
          <button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-muted"></span></button>
        </div>';
      } else {
        // heart button
        $notes_heart_button = '
        <div class="heart">
          <button type="button" action="javascript: void(0)" class="btn p-0" title="Favourite"><span class="icon icon-heart text-danger"></span></button>
        </div>';
      }
      
      echo '
        <div class="card p-2 border-0">
          <div class=" d-flex justify-content-between">
            <div class="note-link"><a href="'.$note_id.'">'.$note.'</a></div>
            '.$notes_heart_button.'
          </div>
          <div class="d-flex justify-content-start">
            <div class="text-muted me-2">'.format_time($created_on).'</div>
          </div>
        </div>';
    }

    // no results found
    if ($total_notes > 0) {
      // show searched results...
    } else {
      echo "
        <div class='card p-5 border-0 text-center'>
          <h1><span class='icon icon-doc-text-inv text-muted'></span></h1>
          <p class='text-muted'>No note found</p>
        </div>";
    }

    // close statement
    mysqli_stmt_close($stmt);
  } 
  // close database connection
  mysqli_close($db);

  // search preview if true or false
  if ($keyword == true) {
    // show searched results...
  } elseif ($keyword == false) {
    echo '
    <div class="card p-5 border-0 text-center">
      <h1><span class="icon icon-doc-text-inv text-muted"></span></h1>
      <p class="text-muted">Search notes</p>
    </div>';
  }
?>