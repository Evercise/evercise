<?php

    class Slider extends Eloquent
    {

        protected $table = 'slider';
        protected $fillable = ['image', 'evercisegroup_id', 'date_end', 'active'];
        protected $hidden = ['created_at', 'updated_at'];
        protected $dates = ['date_end'];


        public function evercisegroup()
        {
            return $this->belongsTo('Evercisegroup', 'evercisegroup_id');
        }


        public function getItems($limit = 5)
        {


            $items  = [];
            $sliders = static::where('active', 1)->get();

            $i = 0;
            foreach ($sliders as $slider) {

                $class = $slider->evercisegroup()->first();

                $session = $class->evercisesession()->where('date_time', '>=',
                    DB::raw('NOW()'))->orderBy(
                    'price',
                    'asc'
                )->first();

                if ($session) {
                    $items[] = $this->formatItem($slider, $session, $class);
                    $i++;
                }

                if ($i == $limit) {
                    break;
                }
            }


            if (count($items) < $limit) {
                Log::error('Need more Slider ITEMS FAST!!!!');
            }


            return $items;

        }

        public function formatItem($slider, $session, $class)
        {
            $item          = $session->toArray();
            $item['image'] = $slider->image;
            $item['name'] = $class->name;
            $item['description'] = $class->description;



            return $item;
        }


    }