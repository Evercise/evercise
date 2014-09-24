<?php

return [

    'message_deletable' => '<p>Would you really like to delete this class?</p>
            <br/>',
    'message_sessions_warning' => '<p>This Class has sessions. If you delete it, all sessions will also be deleted</p>
			<br/>',
    'message_future_sessions' => '<p>You can not delete a class that has members that have joined upcoming sessions</p>
			<br>
			<p>If there is an issue with this class please '. HTML::linkRoute('static.contact_us', 'Contact Us') .'</p>',
    'message_past_sessions' => '<p>You can not delete a class which has previously had members signed up to it</p>
			<br>
			<p>If there is an issue with this class please '. HTML::linkRoute('static.contact_us', 'Contact Us') .'</p>',
];