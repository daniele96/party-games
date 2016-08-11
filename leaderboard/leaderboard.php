<div class="mdl-layout__drawer leaderboard" style="background: none; border: none; box-shadow: none;">
    <?php
    try {
        //init a new game session
        $mySession = new GameSession(SESSION_ID, DEVICE_IP);
        $user = new User(SESSION_ID, DEVICE_IP);

        $user_session = $_SESSION['user'];

        //load the current game details
        if (!$game = $mySession->loadUsers($user_session['code'])) {
            //game was not found
        } else {
            //game was found
            $displayCount = 0;
            $place = 0;
            foreach($game['users'] as $user) {
                $place++;
                if(!$user['is_display']) {
                    if($user['id'] == $user_session['userid']) {
                        ?>
                        <div class="mdl-card mdl-shadow--6dp player me">
                        <?php
                    } else {
                        ?>
                        <div class="mdl-card mdl-shadow--6dp player">
                        <?php
                    }
                        ?>
                        <div class="mdl-card__supporting-text">
                            <h5 class="place"><?php echo $place; ?>.</h5>
                            <img src="<?php echo $user['picture']; ?>" border="0" alt="" />
                            <h5><?php echo $user['display_name']; ?></h5>
                        </div>
                    </div>
                    <?php
                } else {
                    $displayCount++;
                }
            }

            if(count($game['users']) == $displayCount) {
                ?>
                <p class="fade">Waiting for players...</p>
                <?php
            }
        }
    } catch (Exception $e) {
        //show any errors
        $msg = "Caught Exception: " . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile();
    }

    $drawerIcon = "<script src='/leaderboard/leaderboard.js'></script>";
    ?>
</div>