<div class="donut-chart">
	<canvas  data-total='{{ $total }}' data-filled="{{ $fill }}"  height="120" width="120" id="{{ $id}}" ></canvas>
	<div class="canvas-overlay"><strong>{{ $fill }}</strong>/{{ $total }}</div>
</div>