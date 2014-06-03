@extends('layouts.master')


@section('content')
    <div id="about" class="center_col">
        {{ HTML::image('/img/WIE_1.jpg', 'showing of potatoe' , array('class' => 'wei')); }}
        <h2>What is Evercise?</h2>
        <p>Evercise is an online network that gives <br>
        <b>everyone</b> wanting to <b>exercise</b> access to fitness instructors and classes across London.<br>
        We understand that if you have a busy lifestyle,<br> you can&apost necessarily commit to a rigid fitness regime. That&aposs what makes Evercise different.<br>
        You can choose your class by location, trainer or type, and you don&apost need to sign up for a whole course at once, you can join on a class-by-class basis.<br>
        Your fitness: your terms. After joining a class, you will receive a booking confirmation with all the useful details<br>
        (you will also receive a handy reminder the day before the class).<br>
        With Evercise, organising your fitness is easy, fun and flexible.</p>

        <hr>
        {{ HTML::image('/img/WIE_2.jpg', 'potatoe fitness idea' , array('class' => 'wei')); }}

        <h2>Community</h2>
        <p>At Evercise we don&apost underestimate the motivational power of camaraderie. <br>
        Exercising in a group inspires greater willpower and discipline, and therefore greater results! <br>
        It significantly reduces the cost of the class per participant,<br>
        and because there are so many people wanting so many different things, <br>
        there is a huge variety of classes to choose from.<br>Use our Evercise community to find people with similar fitness requirements, <br>
        and a trainer to suit those requirements. <br>
        From the moment you book a class you can talk to other members of the class <br>
        and the trainer through the <i>Community Thread.</i> Share your experiences, write reviews and club together to request more classes from the same trainer.</p>

        <hr>
        {{ HTML::image('/img/WIE_3.jpg', 'potatoe group fitness class' , array('class' => 'wei')); }}
        <h2>Evercise for the Instructor</h2>
        <p>If you are a professional trainer teaching any fitness class indoors or outdoors, <br>
        Evercise can help you achieve your goals. By setting up a professional account <br>
        (which is free by the way), <br>
        you can advertise your services to a wide range of potential participants.<br>
        Increase the number of participants in a class you run, <br>
        or create interest in a new class you are developing. 
        Promote your services, showcase your skills, and create unique events. <br>
        Evercise is a great platform for organisation, too. <br>
        Setting up and getting paid for classes through Evercise couldn&apost be easier. <br>
        <b>To find out more, visit our {{ HTML::linkRoute('trainers.create', 'Be a pro') }}</b></p>

        <hr>

        {{ HTML::image('/img/boxdes1.png', 'evercise fitness class box' , array('class' => 'wei')); }}
        <br>
        <br>
        <br>
        <h2>Understanding the Class Panels</h2>
        <p>When a trainer organises a class, it will be displayed as a panel (please see example above) on your  {{ HTML::linkRoute('home', 'user dashboard') }}. Each panel shows the class description and basic information. You can click on the panel to view further information about the specific class.<br>The yellow bar, or <i>joining percentage,</i> represents the class availability, showing how many people have joined and how many spaces are left.<br>The star rating represents the feedback that the trainer has received from previous classes.<br>Once you have joined a class we cannot offer a refund if you pull out, but you will receive a full refund if the class is cancelled.</p>
        
      
    </div>
@stop