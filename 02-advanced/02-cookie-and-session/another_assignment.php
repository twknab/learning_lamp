<?php session_start(); ?>
<!-- Because we already generated a session in `another_assignment.php`, this value will be the same. -->

<!-- We can view the session_id() here -->
<?php echo session_id(); ?>

<!--
How does this work?

- When PHP reads the code session_start(), it generates an encrypted string in the background and set it as the user's session id if session id doesn't exist yet.

- This session id is stored somewhere in the server's file system, Apache, typically in the /tmp folder.

- At the same time, session_start() also created a small cookie file in the user's browser containing the session id value. This revelation tells us that session need cookies.

- If we refresh our page, PHP then reads the session_start() code again, but this time PHP will notice that session id is already set, via the existence of a cookie.

  - So if the cookie's session id is equal to the server's session id then it's safe to assume that the user who's on the same page right now is the same user who accessed the page a few seconds ago.
-->
