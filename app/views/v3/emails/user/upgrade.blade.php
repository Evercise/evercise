@extends('v3.emails.template')


@section('body')

<p>Hi <span class="blue-text">{{$name}}</span></p>

<p>Here are a few tips to get you started.</p>
<ul>
	<li><strong>Create classes: </strong><p>Simply click “class hub” on the navigation bar, then “create a new class”. Add all the class details and a photo to represent it. Choose a category so your class is easily searchable. Add your venues, which will appear in a drop down menu the next time you create a class.</p></li>
	<li><strong>Manage classes online: </strong><p>View participant lists and easily contact those who have joined. You can delete a class up until it has its first participant. View class statistics onthe class hub page, so that you can monitor the progress and success of a class.</p>
	</li>
	<li><strong>Run classes at your chosen location: </strong><p>Make sure all of your participants know where to go, at what time they should arrive, how to dress appropriately for the class and if they should bring anything e.g. water</p>
	</li>
	<li><strong>Get Rated: </strong><p>Be sure to ask participants to rate you after a class so that you can build a reputation and gain trust within the Evercise community!</p>
	</li>
</ul>

@stop
