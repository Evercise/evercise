<!DOCTYPE html>
  <html lang="en">
  <head>
  	<title>{{ isset($title)? $title : 'Everyone exercise'}}</title>
  	<meta name="description" content="{{ isset($metaDescription)? $metaDescription : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
  	<meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


  {{ HTML::style('assets/css/main.css') }}

  </head>
  <body>
    <div class="container">
       <h1><u>// Heading tags</u></h1>
       <h1>h1. Heading 34px <small>Secondary text</small></h1>
       <h2>h2. Heading 30px <small>Secondary text</small></h2>
       <h3>h3. Heading 24px <small>Secondary text</small></h3>
       <h4>h4. Heading 20px <small>Secondary text</small></h4>
       <h5>h5. Heading 14px <small>Secondary text</small></h5>
       <h6>h6. Heading 12px <small>Secondary text</small></h6>
       <br>
       <h1><u>// paragraphs</u></h1>
       <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
       <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a</p>
       <p class="lead">This is a lead paragraph</p>
       <p class="text-left">Left aligned text.</p>
        <p class="text-center">Center aligned text.</p>
        <p class="text-right">Right aligned text.</p>
        <p class="text-justify">Justified Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum. Vivamus fermentum in arcu in aliquam.</p>
        <p class="text-nowrap">No wrap text.</p>
       <br>
       <h1><u>// Buttons</u></h1>
       <button class="btn btn-primary">whomp</button>
    </div>

  </body>
  </html>