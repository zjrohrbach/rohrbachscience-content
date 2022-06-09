<?php
session_start();
include 'functions.php';
?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>URL Shortener</title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.14.1/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.14.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.14.1/dist/js/uikit-icons.min.js"></script>

    <script>

      function sendAlert(thisMessage, thisStatus) {
        /* function for sending alert to UIKit */
        UIkit.notification({
                    message: thisMessage,
                    status: thisStatus,
                    timeout: <?php echo $alert_timeout; ?>
        });
      }
      
      function copyText(inputID) {
        /* Get the text field */
        var textForClipboard = document.getElementById(inputID);

        /* Select the text field */
        textForClipboard.select();
        textForClipboard.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(textForClipboard.value);

        /* Alert the copied text */
        sendAlert("Copied to clipboard.", "success");
      } 

      /* this makes it so that reloading the page doesn't re-submit data */
      window.history.replaceState(null, null, 'index.php');

    </script>
  </head>
  <body>

    <div class="uk-container">
      <h1>Link Shortener</h1>

      <?php
        //what to do if the form has been submitted
        if ( isset( $_POST['url'] ) ) {

          add_new_link ( $_POST['slug'], $_POST['url'] );

        }

        //what to do with delete request
        if ( isset( $_GET['delete'] ) && is_numeric( $_GET['delete'] ) ) {
          
          delete_link ( $_GET['delete'] );

        }

        //showing details for individual link
        if ( isset( $_GET['detail'] ) && is_numeric( $_GET['detail'] ) ) {
          
          show_details ( $_GET['detail'] );

        }

        //process login
        if ( isset( $_POST['pwd'] ) ) {
          if ( $_POST['pwd'] == $correct_pwd ) {
            $_SESSION['login'] = true;
          } else {
              echo "Incorrect Login.";
          }
        }

        //kick anyone out who isn't supposed to be here
        if ( !isset($_SESSION['login']) && $password_required ) {
          echo '
            <form action="index.php" method="post">
              <div>
                <input type="password" id="pwd" name="pwd" />
                <input type="submit" value="Login" />
              </div>
            </form>
          ';
          exit;
        }

      ?>

      <section class="uk-section uk-section-muted uk-section-large uk-padding-remove-vertical"> 
        <h2>Shorten a new link</h2>
        <form action="index.php" method="post">
          <div class="uk-grid uk-grid-small">
            <div>
              <label class="uk-form-label" for="url">url:</label> 
              <input class="uk-form-input uk-form-width-large" type="url" id="url" name="url" 
                pattern="https?://.+" 
                placeholder="https://" 
                required />
            </div>
            <div>
              <label class="uk-form-label" for="slug">slug:</label> 
              <input class="uk-form-input uk-form-width-small" type="text" id="slug" name="slug" 
                pattern="[0-9a-zA-Z\-]+" 
                required />
            </div>
            <div>
              <input class="uk-button uk-button-primary uk-button-small" type="submit" value="Submit" />
            </div>
          </div>
        </form>
      </section>

      <h2>Active slugs and redirects</h2>

      <div class="uk-grid-small uk-child-width-1-1" uk-grid>
      <?php
        //pull all the slug-link pairs for display
        $query = '
          SELECT redirects.link_id, redirects.slug, redirects.url, redirects.date_created, COUNT(visits.visit_date) AS num_visits, MAX(visits.visit_date) AS last_visit
            FROM redirects
            LEFT JOIN visits
            ON redirects.link_id = visits.link_id
          GROUP BY redirects.link_id
          ORDER BY redirects.date_created DESC;';
        $result = $connection->query($query);


        while ( $row = $result->fetchArray() ) {
          echo '
          <div class="uk-margin-left uk-card uk-card-body uk-card-default uk-card-hover">
            <h3 class="uk-card-title">' . $row['slug'] . '</h3>
            <p class="uk-text-small uk-overflow-hidden">' . $row['url'] . '</p>
            <div class="uk-height-match uk-grid">

              <div class="uk-width-expand">
                <input type="text" 
                id="copy-' . $row['link_id'] . '" 
                class="uk-input uk-form-small uk-width-expand"
                value="' . $base_url . $row['slug'] . '"
                disabled />
              </div>
              <div class="uk-width-auto uk-padding-remove">
                <a href="javascript:copyText(\'copy-' . $row['link_id'] . '\')" uk-tooltip="copy shortened url"><span uk-icon="copy"></span></a>
              </div>

              <div class="uk-width-auto">
                <a href="index.php?detail=' . $row['link_id'] . '" class="uk-label" uk-tooltip="visit details"><span uk-icon="list"></span></a>
                <button type="button" class="uk-button uk-label uk-label-danger" uk-tooltip="delete this url"><span uk-icon="close"></span></button>
                <div class="uk-width-5-6" uk-drop="mode: click; pos: top-right">
                  <div class="uk-card uk-card-body uk-card-default uk-background-muted">
                    <div class="uk-padding-remove">
                      Are you sure you want to delete <em>' . $row['slug'] . '</em>?
                    </div>
                    <div class="uk-align-right">
                      <a class="uk-label uk-drop-close">Cancel</a>
                      <a href="index.php?delete=' . $row['link_id'] . '" class="uk-label uk-label-danger">Delete</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
           
            <ul>
              <li>Date Created: ' . $row['date_created'] . '</li>
              <li>Number of Visits: ' . $row['num_visits'] . '</li>
              <li>Last Visit: ' . $row['last_visit'] . '</li>
            </ul>
          </div>
          ';
        }

      ?>

      </div>
    </div>
  </body>
</html>
<?php $connection->close() ?>