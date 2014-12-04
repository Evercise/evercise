 @extends('v3.emails.template')



 @section('body')

 $data['userList'] = $userList;


        // ------ SEND EMAIL TO TRAINER ------
        $body = '
			<p>Hi ' . $trainerName . ',</p>

			<p>You have arranged the class ' . $group . ' to take place tomorrow ' . date('d-M-Y', strtotime($dateTime)) . ' at ' . date('h:m', strtotime($dateTime)) . '.</p>

			<p>Please note that more participants can join up until one hour before the class is due to commence.</p>';

        $body .= '
            <table align = "left" width = "600" cellpadding = "0" cellspacing = "0" bgcolor = "#ffffff" style = "font-family: lato, Helvetica, ‘Helvetica Neue’, Arial; padding: 0px 0px 20px 0px " >
                <tr align = "left" height = "20" bgcolor = "#180B16" style = "font-style:italic;color:#ffffff; font-size:12px; " >
                    <th colspan = "2" style = "border:1px solid #ffffff; padding: 0px 5px 0px 5px;" >
                        Your Participant list
                    </th >
                </tr >
                <col width = "200" style = "background-color: #FFD21E; color: #000000 ;" />
                <col span = "2" style = "background-color: #FFF6D0; color: #000000;" />
        ';


        foreach ($userList as $name => $userEmail)
        {
            $body .= '
                 <tr height = "20" >
                    <td style = "border:1px solid #ffffff; font-weight:bold; font-size:12px; font-style:italic;padding: 0px 5px 0px 5px;" >
                        Name
                    </td >
                    <td style = "border:1px solid #ffffff; font-size:12px; padding: 0px 5px 0px 5px;" >
                       ' . $name . '
                    </td >
                </tr >

            ';
        }

        $body .= '</table>';


        $body .= '
            <br>
            <br>
			<p style="margin-top: 40px">We hope it goes well!</p>

			<p>If you have any problems, please get in contact. We’re always happy to help.</p>
		';


        $subject = 'Class reminder & participant list';
        //$view = 'emails.auth.welcome'; // use for validation email
        $view = 'emails.template';
        $data['title'] = $subject;
        $data['mainHeader'] = 'Feeling prepared?';
        $data['subHeader'] = 'Your arranged class will take place in less than 24 hours.';
        $data['body'] = $body;
        $data['link'] = HTML::linkRoute('evercisegroups.show', 'Class page', $classId);
        $data['linkLabel'] = 'Go to your class hub: ';


        $this->sendTo($trainerEmail, $subject, $view, $data);



 @stop
