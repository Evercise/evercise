@extends('layouts.master')


@section('content')
@include('layouts.pagetitle', array('title'=>'Evercise Team', 'subtitle'=>'Meet the brains behind Evercise!'))
    <div id="the-team" class="col10 push1">
    <aside>
    		{{ HTML::image('/img/lewis.jpg', 'Lewis Bayfield' , array('class' => 'team-img')); }}
    		<h3>Lewis Bayfield</h3>
    		<h5>Development Manager</h5>
    		<div class="team_blurb">
	    		<p><strong>Favourite food:</strong> Steak and ale pie (from shefield)</p>
	    		<p><strong>Hobby(s):</strong> Motorbiking & playing bass guitar</p>
	    		<p><strong>Favourite Quote:</strong> <q>Smoke me  kipper Ill be back for breakfast</q></p>
    		</div>
    	</aside>
    	<aside>
    		{{ HTML::image('/img/nas.jpg', 'Naseeim Bangura' , array('class' => 'team-img')); }}
    		<h3>Naseeim Bangura</h3>
    		<h5>Marketing and Sales Specialist</h5>
    		<div class="team_blurb">
	    		<p><strong>Favourite food:</strong> Spaghetti Bolognese. Can't beat a bit of Spag Bol!</p>
	    		<p><strong>Hobby(s):</strong> Road trips & playing the violin</p>
	    		<p><strong>Favourite Quote:</strong> <q>There is no such thing as a hopeless situation. Every single circumstance of your life can change!</q></p>
    		</div>
    	</aside>
    	<aside>
    		{{ HTML::image('/img/taneis.jpg', 'Tanais Gustave' , array('class' => 'team-img')); }}
    		<h3>Tanaïs Gustave</h3>
    		<h5>Marketing Specialist</h5>
    		<div class="team_blurb">
	    		<p><strong>Favourite food:</strong> Fruits :)</p>
	    		<p><strong>Hobby(s):</strong> Singing with Lewis Bayfield</p>
	    		<p><strong>Favourite Quote:</strong> <q>Positive mind, positive life</q></p>
    		</div>
    	</aside>

    	<aside>
    		{{ HTML::image('/img/tristan.jpg', 'Tanais Gustave' , array('class' => 'team-img')); }}
    		<h3>Tristan Allen</h3>
    		<h5>Developer</h5>
    		<div class="team_blurb">
	    		<p><strong>Favourite food:</strong> Steak</p>
	    		<p><strong>Hobby(s):</strong> Climbing and mountain biking</p>
	    		<p><strong>Favourite Quote:</strong> <q>Tinder is life</q></p>
    		</div>
    	</aside>


    </div>
@stop