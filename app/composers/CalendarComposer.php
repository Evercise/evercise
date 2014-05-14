<?php
 
class CalendarComposer {
 
  public function compose($view)
  {
	$calendarData = array();

	$template = '
	   {table_open}<table border="0" cellpadding="0" cellspacing="0" id="calendar">{/table_open}

	   {heading_row_start}<tr>{/heading_row_start}

	   {heading_previous_cell}<th><a href="{previous_url}">&#171;</a></th>{/heading_previous_cell}
	   {heading_title_cell}<th colspan="{colspan}"><h6>&#171;{heading}&#0187;</h6></th>{/heading_title_cell}
	   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

	   {heading_row_end}</tr>{/heading_row_end}

	   {week_row_start}<tr class="calendar-days">{/week_row_start}
	   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
	   {week_row_end}</tr>{/week_row_end}

	   {cal_row_start}<tr>{/cal_row_start}
	   {cal_cell_start}<td>{/cal_cell_start}

	   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
	   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

	   {cal_cell_no_content}<a href="#" id="day_{day}">{day}</a>{/cal_cell_no_content}
	   {cal_cell_no_content_today}<a href="#" id="day_{day}"><div class="highlight">{day}</a></div>{/cal_cell_no_content_today}

	   {cal_cell_blank}&nbsp;{/cal_cell_blank}

	   {cal_cell_end}</td>{/cal_cell_end}
	   {cal_row_end}</tr>{/cal_row_end}

	   {table_close}</table>{/table_close}
	';

	JavaScript::put(array('price' => json_encode(array('min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));

	Calendar::initialize(array('template' => $template));

	$view->with('calendarData', $calendarData);
  }
 
}