<?php namespace composers;

use JavaScript;

class ClassPurchaseComposer {

	 public function compose($view)
  	{
		  JavaScript::put(
        [
          'overrideGaPageview'   =>    json_encode(['pageview' => '/class-order'])
        ]
      );
  	}
}