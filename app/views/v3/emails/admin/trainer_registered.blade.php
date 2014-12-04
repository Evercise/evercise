 @extends('v3.emails.template')

 object $user


 @section('body')


Email to admin about the new Trainer
       $body = '
       			<p>Hi</p>
       			<p>A new trainer has signed up, please verify the account</p>
       			<p>Email: '.$email.'</p>
       			<p>Display Name: '.$display_name.'</p>
       		';


               $subject = 'Evercise trainer verification';
               $view = 'emails.template';
               $data['title'] = 'Evercise trainer verification';
               $data['mainHeader'] = 'A new trainer is awaiting verification';
               $data['subHeader'] = 'You will need to be logged in with an admin account';
               $data['body'] = $body;
               $data['link'] = HTML::linkRoute('admin.pendingtrainers', 'Pending Trainers');
               $data['linkLabel'] = 'Verify the new trainer here:';

               return $this->sendTo(getenv('EMAIL_ADMIN'), $subject, $view, $data );

 @stop
